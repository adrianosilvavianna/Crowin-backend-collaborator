<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
		* Get table
    *
    * @var string
    */
    protected $table = 'products';

    public function Auction()
    {
        return $belongsTo(Auction::class);
    }
}
