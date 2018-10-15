<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable = [];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function winner()
    {
        return $this->belongsTo('App\User', 'winner_id');
    }

    public function bids()
    {
        return $this->hasMany('App\Bid');
    }
}
