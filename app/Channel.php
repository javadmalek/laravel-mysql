<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    /***
     * The Channel belongs to a Company who are stored in companies table
     * it could be retrievable by Channel::find(1)->company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function company()
    {
        return $this->belongsTo('App\Company', '_company_id');
    }

    /**
     * The Channel has many RFQs who are stored in RFQs table
     * it could be retrievable by Channel::find(1)->RFQs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rfqs()
    {
        return $this->hasMany('App\Rfq', '_channel_id');

    }

}
