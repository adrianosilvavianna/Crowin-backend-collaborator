<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable = [];

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    public function Winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }

    public function Bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function Favorites()
    {
        return $this->belongsToMany(User::class, 'auction_user_favorites');
    }
}
