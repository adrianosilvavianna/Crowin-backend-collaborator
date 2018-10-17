<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AuctionResource;
use App\Http\Controllers\Controller;
use App\Models\Auction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
		protected $auction;

    public function __construct(Auction $auction)
    {
        $this->auction = $auction;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
		 */
    public function index()
    {
        $auctions = $this->auction->where('inicio', '>=', Carbon::now()->toDateTimeString())->get();
        return AuctionResource::collection($this->auction->all());
    }

    /**
     * Display the specified resource.
     *
     * @param Auction $auction
     * @return AuctionResource
     */
    public function show(Auction $auction)
    {
        return new AuctionResource($auction);
    }
}
