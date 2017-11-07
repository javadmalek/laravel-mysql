<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rfq extends Model
{
    /***
     * The RFQ belongs to a Channel who are stored in Channels table
     * it could be retrievable by RFQ::find(1)->Channel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function Channel()
    {
        return $this->belongsTo('App\Channel', '_channel_id');
    }
}
