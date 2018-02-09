<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RfqOfferSpecifications extends Model
{
    protected $table = 'rfqoffersspecifications';

    public function offer()
    {
        return $this->belongsTo('App\RfqOffer', '_offer_id');
    }
}
