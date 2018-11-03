<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use Illuminate\Http\Request;

class BidController extends Controller
{
    protected $bid;
    protected $user;

    /**
     * BidController constructor.
     *
     * @param Bid $bid
     */
    public function __construct(Bid $bid)
    {
        $this->bid = $bid;
        $this->user = auth()->user();
    }

    /**
     * @return mixed
     */
    public function history()
    {
        return $this->user->Bids->groupBy('auction_id')->count();

    }

    /**
     * @return mixed
     */
    public function getCountBids()
    {
        return $this->user->bids;
    }
}
