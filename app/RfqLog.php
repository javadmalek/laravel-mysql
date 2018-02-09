<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RfqLog extends Model
{
    protected $table = 'rfqlogs';

    public function log()
    {
        return $this->belongsTo('App\Rfq', '_rfq_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', '_user_id');
    }

    public function offer()
    {
        return $this->belongsTo('App\RfqOffer', '_offer_id');
    }

    public static function createLog($_rfq_id, $_user_id, $_offer_id, $_action, $_description)
    {
        $rfqLog = new RfqLog();
        $rfqLog->_user_id = $_user_id;
        $rfqLog->_rfq_id = $_rfq_id;
        $rfqLog->action = $_action;
        $rfqLog->description = $_description;

        if($_offer_id !== '' && $_offer_id !== null )
            $rfqLog->_offer_id = $_offer_id;

        $rfqLog->save();
        return $rfqLog;
    }
}
