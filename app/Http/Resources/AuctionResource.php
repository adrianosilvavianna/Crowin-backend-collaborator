<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AuctionResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'name' => $this->name,
            'description' => $this->description,
            'start' => $this->inicio,
            'payment_status' => $this->payment_status,
            'slug' => $this->slug,
            'created_at' => $this->created_at
        ];
    }
}
