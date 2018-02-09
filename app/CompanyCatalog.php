<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyCatalog extends Model
{
    protected $table = 'companycatalogs';

    public function offer()
    {
        return $this->belongsTo('App\Company', '_company_id');
    }
}
