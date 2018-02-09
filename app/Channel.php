<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public function company()
    {
        return $this->belongsTo('App\Company', '_company_id');
    }

    public function rfqs()
    {
        return $this->hasMany('App\Rfq', '_channel_id')->orderBy('id', 'desc');
    }
    public function rfqsNotDrafted()
    {
        return $this->hasMany('App\Rfq', '_channel_id')
            ->where('status', '<>', 'DRAFTED')
            ->where('cancel_requested', '=', 'NO')
            ->orderBy('id', 'desc');
    }

    public function variables()
    {
        $instances = $this->hasMany('App\ChannelVariable', '_channel_id');
        return $instances;
    }

    public function canDelete()
    {
        if(count($this->rfqs) == 0 )
            return true;
        else
            return false;
    }
}
