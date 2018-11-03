<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id','auction_id'];

    /**
    * Get table
    *
    * @var string
    */
    protected $table = 'bids';

    /**
     * @return mixed
     */
    public function Auction()
    {
        return $this->belongsTo(Auction::class);
    }

    /**
     * @return mixed
     */
    public function User()
    {
        return $this->belongsTo(User::class);
    }



}
