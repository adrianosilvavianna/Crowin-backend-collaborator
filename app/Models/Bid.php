<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    /**
    * Get table
    *
    * @var string
    */
    protected $table = 'products';

    spublic function Auction()
    {
        return $belongsTo(Auction::class);
    }

    public function User()
    {
        return $belongsTo(User::class);
    }
}
