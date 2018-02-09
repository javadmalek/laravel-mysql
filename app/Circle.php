<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{
    public function srcCompany()
    {
        return $this->belongsTo('App\Company', '_src_company_id');
    }
    public function dstCompany()
    {
        return $this->belongsTo('App\Company', '_dst_company_id');
    }

}
