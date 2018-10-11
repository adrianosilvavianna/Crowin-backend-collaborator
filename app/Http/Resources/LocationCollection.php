<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LocationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'address'       => $this->address,
            'city'          => $this->city,
            'number'        => $this->number,
            'zip_code'      => $this->zip_code,
            'district'      => $this->district,
            'complement'    => $this->complement,
        ];
    }
}
