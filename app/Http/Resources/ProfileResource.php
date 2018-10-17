<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProfileResource extends Resource
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
            'id' => $this->id,
            'photo_address' => $this->photo_address,
            'age' => $this->age,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'about' => $this->about,
            'cpf' => $this->cpf,
        ];
    }
}
