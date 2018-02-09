<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Requests;
use App\RfqOfferSpecifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\RfqOffer;
use App\RfqLog;
use App\Channel;
use App\User;

use Validator, Input, Redirect, Session;
use View;


class RfqOfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($_channel_id, $_rfq_id)
    {
        $userType = Auth::user()->type;
        if ($userType == 'SUPPLIER') {
            $rfq = Channel::find($_channel_id)->rfqs->find($_rfq_id);

            if ($rfq) {
                // if there is an offer by this user => error 400 Bad.Request
                if (($offer = $rfq->getOfferBySupplierId(Auth::user()->_company_id)))
                    return response()->view('errors.400');

                return View::make('offers.supplier.create', ['rfq' => $rfq, '_channel_id' => $_channel_id]);
            }
        }
        return response()->view('errors.403');
    }

    public function store($_channel_id, $_rfq_id, Request $request)
    {
        $offer = new RfqOffer();
        $offer->_rfq_id = $_rfq_id;
        $offer->_supplier_company_id = Auth::user()->_company_id;
        $offer->status = 'DRAFTED';
        $offer->description = '';

        $channel = Channel::find($_channel_id);
        $offer->_purchaser_company_id = $channel->_company_id;

        // if there is an offer by this user => error 400 Bad.Request
        $rfq = Channel::find($_channel_id)->rfqs->find($_rfq_id);
        if (($tmp = $rfq->getOfferBySupplierId(Auth::user()->_company_id)))
            return response()->view('errors.400');

        $offer->save();

        $rfq = $channel->rfqs->find($_rfq_id);

        $offerItems = array();
        foreach ($rfq->rfqSpecifications as $key => $specification) {
            switch ($specification->_section) {
                case 'SPEC':
                    $type = $specification->type;
                    $value = $specification->value;
                    if ($specification->is_mandatory == 'NO')
                        $value = Input::get("key" . $specification->id);

                    array_push($offerItems, ['_offer_id' => $offer->id, '_rfqspec_id' => $specification->id, 'type' => $type, 'value' => $value]);
                    break;

                case 'SCHE':
                    $key_start = $specification->type;
                    $key_end = $specification->value;
                    if ($specification->is_mandatory == 'NO') {
                        $key_start = Input::get("key_start_" . $specification->id);
                        $key_end = Input::get("key_end_" . $specification->id);
                    }

                    array_push($offerItems, ['_offer_id' => $offer->id, '_rfqspec_id' => $specification->id, 'type' => $key_start, 'value' => $key_end]);
                    break;

                case 'PRICE':
                    $price_curr = Input::get("price_curr_" . $specification->id);
                    $price_amount = Input::get("price_amount_" . $specification->id);

                    array_push($offerItems, ['_offer_id' => $offer->id, '_rfqspec_id' => $specification->id, 'type' => $price_curr, 'value' => $price_amount]);
                    break;

                case 'MEDIA':
                    break;

                default:
                    return response()->view('errors.403');
            }
        }

        DB::table("rfqoffersspecifications")->insert($offerItems);

        RfqLog::createLog($rfq->id, Auth::user()->id, $offer->id, 'OFFERING', Auth::user()->name . ' made an offer');

        Session::flash('message', 'Successfully created your Offer!');
        return Redirect::to('supplier/channels/'.$_channel_id.'/'.$_rfq_id);
    }

    public function update($_channel_id, $_rfq_id, $id, Request $request)
    {
        $rules = array(
            'value' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('supplier/channels/' . $_channel_id . '/' . $_rfq_id)
                ->withErrors($validator);
        } else {
            $rfqOfferSpec = RfqOfferSpecifications::where('id', '=', $id)->first();

            if ($rfqOfferSpec) {
                $_section = Input::get('_section');
                $rfqOfferSpec->value = Input::get('value');

                if ($_section == 'SCHE') {
                    $rfqOfferSpec->type = date('Y-m-d', strtotime(Input::get('type')));
                    $rfqOfferSpec->value = date('Y-m-d', strtotime(Input::get('value')));
                }
//                else if($rfqSpec->_section == 'MEDIA') {
//                    if(Input::hasFile('value')) {
//                        $file = Input::file('value');
//                        $filename = md5($file->getClientOriginalName() . time());
//                        $filename = str_replace(' ', '_', $filename);
//
//                        //ToDo: Remove t6hew old file then Upload the new one
//                        Storage::disk('minio')->put('channels/' . $_channel_id . '/rfqs/' . $_rfq_id . '/' . $filename, file_get_contents($file));
//                        $rfqSpec->value = $filename;
//                    } else
//                        return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs/' . $_rfq_id . '/edit')
//                            ->withErrors('No file is Selected');
//                }

                $rfqOfferSpec->save();
                RfqLog::createLog($_rfq_id, Auth::user()->id, $rfqOfferSpec->offer->id, 'EDIT_OFFER', Auth::user()->name . ' modified the offer, OfferSpecId:' . $rfqOfferSpec->id);

                Session::flash('message', 'Successfully updated RFQ specification!');
                return Redirect::to('supplier/channels/' . $_channel_id . '/' . $_rfq_id);
            }
        }
        return response()->view('errors.403');
    }
}