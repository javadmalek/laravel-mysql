<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChannelVariable extends Model
{
    protected $table = 'channelvariables';

    public function channel()
    {
        return $this->belongsTo('App\Channel', '_channel_id');
    }

}
