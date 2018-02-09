<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RfqSpecification extends Model
{
    protected $table = 'rfqspecifications';

    public function RFQ()
    {
        return $this->belongsTo('App\Rfq', '_rfq_id');
    }

}
