<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Rfq extends Model
{
    public function Channel()
    {
        return $this->belongsTo('App\Channel', '_channel_id');
    }

    public function type()
    {
        return $this->belongsTo('App\ChannelVariable', '_type_id');
    }

    public function dimension()
    {
        return $this->belongsTo('App\ChannelVariable', '_dimension_id');
    }

    public function RfqSpecifications()
    {
        return $this->hasMany('App\RfqSpecification', '_rfq_id');
    }

    public function RfqOffers()
    {
        return $this->hasMany('App\RfqOffer', '_rfq_id')->orderBy('_rfq_id', 'desc');
    }

    public function RfqNotDraftedOffers()
    {
        return $this->hasMany('App\RfqOffer', '_rfq_id')
            ->where('status', '<>', 'DRAFTED')
            ->where('status', '<>', 'CANCELED')
            ->orderBy('total');
    }

    public function get3Offers()
    {
        if ($this->offer_extention !== 'YES')
            return $this->hasMany('App\RfqOffer', '_rfq_id')
                ->where('status', '<>', 'DRAFTED')
                ->where('status', '<>', 'CANCELED')
                ->orderBy('total')
                ->offset(0)
                ->limit(3);
        else
            return $this->hasMany('App\RfqOffer', '_rfq_id')
                ->where('status', '<>', 'DRAFTED')
                ->where('status', '<>', 'CANCELED')
                ->orderBy('total');
    }

    public function RfqOffersNotRead()
    {
        return $this->hasMany('App\RfqOffer', '_rfq_id')
            ->orderBy('_rfq_id', 'desc')
            ->where('status', '<>', 'DRAFTED')
            ->where('status', '<>', 'CANCELED')
            ->where('is_read', '=', 'NOTREAD');
    }

    public function getOfferBySupplierId($_supplier_id)
    {
        $offer = RfqOffer::where([
            ['_supplier_company_id', '=', $_supplier_id],
            ['_rfq_id', '=', $this->id],
        ])->first();
        return $offer;
    }

    public function logs()
    {
        return $this->hasMany('App\RfqLog', '_rfq_id')->orderBy('_rfq_id', 'desc');
    }

    public function canDelete()
    {
        if (count($this->RfqOffers) == 0)// && count($this->RfqSpecifications) == 0)
            return true;
        else
            return false;
    }

    public function sum()
    {
        return $this->RfqSpecifications()->where('_section', 'PRICE')->sum('value');
    }

    /* RFQ STATUS  */
    public function isOfferingExpired()
    {
        $today = date("Y-m-d");
        if ($this->deadline >= $today)
            return false;
        else
            return true;
    }

    /* Expiration date lead time
        ToDo: Check the time difference after the date difference
    */
    public function is1stLast7Days()
    {
        $today = date("Y-m-d");
        $today = date_create($today);
        $deadline = date_create($this->deadline);

        $interval = date_diff($deadline, $today);
        $dif = $interval->format('%R%a days');

        if (23 <= $dif && $dif <= 30)
            return true;
        else
            return false;
    }

    public function is2ndLast7Days()
    {
        $today = date("Y-m-d");
        $today = date_create($today);
        $deadline = date_create($this->deadline);

        $interval = date_diff($deadline, $today);
        $dif = $interval->format('%R%a days');

        if (53 <= $dif && $dif <= 60)
            return true;
        else
            return false;
    }

    public function isLeadExpired()
    {
        $today = date("Y-m-d");
        if ($this->is_extended == 'YES')
            $today = date('Y-m-d', strtotime($today . ' -60 day'));
        else
            $today = date('Y-m-d', strtotime($today . ' -30 day'));
        if ($this->deadline < $today) {
            // ToDo: RFQ should be terminated automatically.
            return true;
        } else
            return false;
    }

    public function getExtendedDate()
    {
        if ($this->is_extended == 'YES') {
            return date('Y-m-d', strtotime($this->deadline . ' +60 day'));

        } else {
            return date('Y-m-d', strtotime($this->deadline . ' +30 day'));
        }
    }

    public function countNotReadMsgs()
    {
        return count(Message::where('_rfq_id', $this->id)
            ->where('status', 'NOTREAD')
            ->where('_receiver_company_id', Auth::user()->company->id)
            ->get()
        );
    }
}