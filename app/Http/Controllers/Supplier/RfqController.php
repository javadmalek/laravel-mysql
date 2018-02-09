<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Rfq;
use App\RfqOffer;
use App\RfqOfferDeal;
use App\RfqLog;
use App\User;
use App\Message;

use Validator, Input, Redirect, Session;
use View;

class RfqController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return response()->view('errors.403');
    }

    public function show($_channel_id, $id)
    {
        $myRfq = Rfq::find($id);
        if ($myRfq->status == 'PUBLISHED' && $myRfq->isOfferingExpired()) {
            $myRfq->status = 'NEGOTIATION';
            $myRfq->save();
            RfqLog::createLog($id, '', '', 'RFQ_NEGOTIATION', ' The RFQ is in negotiation.');
        }elseif ($myRfq->status == 'NEGOTIATION' && $myRfq->isLeadExpired()) {
            $myRfq->status = 'EXPIRED';
            $myRfq->save();
            RfqLog::createLog($id, '', '', 'RFQ_EXPIRED', ' The RFQ is expired.');
        }

        $_company_id = Auth::user()->_company_id;
        return View::make('rfqs.supplier.show', ['rfq' => $myRfq, '_channel_id' => $_channel_id, '_company_id' => $_company_id]);
    }

    public function status($_channel_id, $_rfq_id, $_offer_id, $_status)
    {
        $rfqoffer = RfqOffer::where('id', '=', $_offer_id)
            ->where('_rfq_id', $_rfq_id)->first();
        if ($rfqoffer) {
            switch ($_status) {
                case 'canceloffer':
                    $rfqoffer->status = 'CANCELED';
                    $rfqoffer->save();

                    $message = 'supplierId: '.Auth::user()->id .' cancelled an offer ';
                    Message::sendEventMsg($rfqoffer->rfq->channel->_company_id,$_rfq_id, $_offer_id, $message );

                    $rfqoffer->messages()->update(['status'=>'READ']);

                    RfqLog::createLog($_rfq_id, Auth::user()->id, $_offer_id, 'CANCEL_OFFER', Auth::user()->name . ' CANCELED the offer');
                    break;

                case 'posting':
                    $rfqoffer->status = 'POSTED';
                    $rfqoffer->save();

                    $message = 'supplierId: '.Auth::user()->id .' posted an offer ';
                    Message::sendEventMsg($rfqoffer->rfq->channel->_company_id,$_rfq_id, $_offer_id, $message );

                    RfqLog::createLog($_rfq_id, Auth::user()->id, $_offer_id, 'POST_OFFER', Auth::user()->name . ' POSTED an offer');
                    break;

                default:
                    return response()->view('errors.403');
                    break;
            }

            /// ToDo: notify the status to supplier
            Session::flash('message', 'Successfully updated RFQ->offer->status changed to ' . $_status);
            return Redirect::to('supplier/channels/' . $_channel_id . '/' . $_rfq_id);
        }
        return response()->view('errors.403');
    }

    public function terminateDeal($_channel_id, $_rfq_id, $_offer_id, $_deal_id)
    {
        $rules = array(
            'action' => 'required',
            'descr' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('supplier/channels/' . $_channel_id . '/' . $_rfq_id)
                ->withErrors($validator);
        } else {

            $action = Input::get('action');
            $descr = Input::get('descr');

            RfqOffer::where('id', '=', $_offer_id)
                ->where('_rfq_id', $_rfq_id)
                ->update(['status' => 'TERMINATE', 'reason' => 'TERMINATED by SUPPLIER ' . $descr]);

            $state = '';
            switch ($action) {
                case 'rejected':
                    $state = 'TERMINATED-REJECTED';
                    break;

                case 'win':
                    $state = 'TERMINATED-WIN';
                    break;

                case 'cancelled':
                    $state = 'TERMINATED-CANCELLED';
                    break;
            }

            RfqOfferDeal::where('id', '=', $_deal_id)
                ->update(['supplier_terminate_status' => $state, 'supplier_terminate_descr' => $descr]);

            Session::flash('message', 'Successfully Terminated');
            return Redirect::to('supplier/channels/' . $_channel_id . '/' . $_rfq_id);
        }
    }
}
