<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RfqOfferDeal extends Model
{
    protected $table = 'rfqoffersdeals';

    public function offer()
    {
        return $this->belongsTo('App\RfqOffer', '_offer_id');
    }
}
