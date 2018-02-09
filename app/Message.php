<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Message extends Model
{
    public function sender()
    {
        return $this->belongsTo('App\Company', '_sender_company_id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Company', '_receiver_company_id');
    }

    public function offer()
    {
        return $this->belongsTo('App\RfqOffer', '_offer_id');
    }

    public static function sendEventMsg($_receiver_company_id, $_rfq_id, $_offer_id, $_msg)
    {
        $message = new Message();
        $message->message = $_msg;
        $message->subject = 'Automatic message:';
        $message->status = 'NOTREAD';
        $message->_sender_user_id = Auth::user()->id;
        $message->_sender_company_id = Auth::user()->_company_id;
        $message->_receiver_company_id = $_receiver_company_id;
        $message->_rfq_id = $_rfq_id;
        $message->_offer_id = $_offer_id;
        $message->save();
    }

    public static function sendNoticeEmail($to, $subject, $message)
    {

    }
}
