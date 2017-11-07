<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'operation_type', 'subscription_plan_type',
    ];

    /**
     * The Company has many users who are stored in users table
     * it could be retrievable by Companies::find(1)->users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User', '_company_id');

    }

    /**
     * The Company has many channels who are stored in channels table
     * it could be retrievable by Companies::find(1)->channels
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function channels()
    {
        return $this->hasMany('App\Channel', '_company_id');

    }
}
