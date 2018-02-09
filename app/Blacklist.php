<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    public function blocker()
    {
        return $this->belongsTo('App\Company', '_blocker_company_id');
    }

    public function blocked()
    {
        return $this->belongsTo('App\Company', '_blocked_company_id');
    }
}