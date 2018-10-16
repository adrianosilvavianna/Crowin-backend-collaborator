<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable = [];

    public function Product()
    {
        return $this->belongsTo('App\Product');
    }

    public function Winner()
    {
        return $this->belongsTo('App\User', 'winner_id');
    }

    public function Bids()
    {
        return $this->hasMany('App\Bid');
    }

    public function Favorites()
    {
        // return $this->belongsToMany('App\Models\User')->using('App\Models\AuctionUserFavorite');
    }
}
