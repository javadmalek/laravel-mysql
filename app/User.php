<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password', '_company_id', 'type',
    ];

    protected $hidden = [
        'password', 'remember_token', '_company_id',
    ];

    public function company()
    {
        return $this->belongsTo('App\Company', '_company_id');
    }

    public function logs()
    {
        $this->hasMany('App\RfqLog', '_user_id')->orderBy('_rfq_id', 'desc');

    }
}
