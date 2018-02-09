<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'title', 'slug', 'operation_type', 'subscription_plan_type',
    ];

    public function users()
    {
        return $this->hasMany('App\User', '_company_id');
    }

    public function channels()
    {
        return $this->hasMany('App\Channel', '_company_id')->orderBy('id', 'desc');
    }

    public function rfqs()
    {
        return $this->hasMany('App\Rfq', '_company_id')->orderBy('id', 'desc');
    }

    public function catalogs()
    {
        return $this->hasMany('App\CompanyCatalog', '_company_id');
    }

    public function offersOut()
    {
        return $this->hasMany('App\RfqOffer', '_supplier_company_id')->orderBy('id', 'desc');
    }

    public function offersIn()
    {
        return $this->hasMany('App\RfqOffer', '_purchaser_company_id')->orderBy('id', 'desc');
    }

    public function inbox()
    {
        return $this->hasMany('App\Message', '_receiver_company_id')->orderBy('id', 'desc');
    }
    public function outbox()
    {
        return $this->hasMany('App\Message', '_sender_company_id')->orderBy('id', 'desc');
    }

    /* Circle */
    public function myCircle()
    {
        return $this->hasMany('App\Circle', '_src_company_id');
    }

    public function isInCircle($_dst_company_id)
    {
        return $this->hasMany('App\Circle', '_src_company_id')
                        ->where('_dst_company_id', '=', $_dst_company_id);
    }
    public function amInCircle($_src_company_id)
    {
        return $this->hasMany('App\Circle', '_dst_company_id')
                        ->where('_src_company_id', '=', $_src_company_id);
    }

    /* BLACKLIST ACTIONS*/
    public function blockedMe()
    {
        return $this->hasMany('App\Blacklist', '_blocked_company_id');
    }

    public function blockedByMe()
    {
        return $this->hasMany('App\Blacklist', '_blocker_company_id');
    }

}