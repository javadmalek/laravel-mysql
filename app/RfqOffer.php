<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RfqOffer extends Model
{
    protected $table = 'rfqoffers';

    public function rfq()
    {
        return $this->belongsTo('App\Rfq', '_rfq_id');
    }

    public function purchaser()
    {
        return $this->belongsTo('App\Company', '_purchaser_company_id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Company', '_supplier_company_id');
    }

    public function offerSpecifications()
    {
        return $this->hasMany('App\RfqOfferSpecifications', '_offer_id');
    }

    public function StatusColor()
    {
        //NOTREAD, JUSTREAD, ACCEPTED, REJECTED, DEALING, CANCELED
        switch ($this->status) {
            case 'DRAFTED':
                return 'm--font-warning';
                break;

            case 'ACCEPTED':
            case 'DEALING':
                return 'm--font-success';
                break;

            case 'REJECTED':
            case 'CANCELED':
                return 'm--font-danger';
                break;

            case 'DEAL':
                return 'm--font-info';
                break;

            case 'TERMINATE-WIN':
            case 'TERMINATE-REJECTED':
            case 'TERMINATE-CANCELLED':
                return 'm--font-danger';
                break;

            default:
                return 'm--font-warning';
                break;
        }
    }

    public function getOfferValue($_rfqspec_id)
    {
        $offerSpec = RfqOfferSpecifications::where([
            ['_offer_id', '=', $this->id],
            ['_rfqspec_id', '=', $_rfqspec_id]
        ])->first();

        return $offerSpec;
    }

    public function deal()
    {
        return $this->hasOne('App\RfqOfferDeal', '_offer_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Message', '_offer_id')->orderBy('id', 'desc');
    }

    public function readMsgs()
    {
        $count = count(
            $this->messages()
            ->where('status', 'NOTREAD')
            ->where('_receiver_company_id', Auth::user()->company->id)
            ->get()
        );
        $this->messages()
            ->where('status', 'NOTREAD')
            ->where('_receiver_company_id', Auth::user()->company->id)
            ->update(['status' => 'READ']);
        return $count;
    }

    public function countNotReadMsgs()
    {
        return count(
            $this->messages()
                ->where('status', 'NOTREAD')
                ->where('_receiver_company_id', Auth::user()->company->id)
                ->get()
        );
    }

    public function logs()
    {
        $this->hasMany('App\RfqLog', '_offer_id')->orderBy('_rfq_id', 'desc');
    }

    public function sum()
    {
        $RfqSpecifications = $this->rfq->RfqSpecifications()->where('_section', 'PRICE')->get();
        $sum = 0;
        foreach ($RfqSpecifications as $value) {
            $offerSpec = $this->getOfferValue($value->id);
            $sum += $offerSpec->value;
        }
        return $sum;
    }

}