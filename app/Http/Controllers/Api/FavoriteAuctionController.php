<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auction;
use Illuminate\Http\Response;

class FavoriteAuctionController extends Controller
{
		private $user;

		public function __construct()
		{
			$this->user = auth()->user();
		}

    public function toChange(Auction $auction)
		{
			try {
				$favorite = $this->user->Favorites()->where('auction_id', $auction->id)->first();
				if(is_null($favorite)){
					$this->user->Favorites()->attach($auction->id);
					return response()->json(['message' => __('messages.created')], Response::HTTP_OK);
				}
				throw new \Exception(__('messages.error_default'));
			} catch (\Exception $e) {
				return response()->json(['message' => $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR]);
			}
		}
}
