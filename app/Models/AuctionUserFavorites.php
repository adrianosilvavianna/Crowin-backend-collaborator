<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuctionUserFavorites extends Model
{
    protected $fillable = ['user_id', 'auction_id'];
}
