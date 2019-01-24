<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProfileResource extends Resource
{
    /**
     * Transform the resource collection into an	 array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $location = [];

        if(isset($this->User->Locations)){
            foreach($this->User->Locations as $lc)
            {
                $location[] = array_merge([
                    'address' => $lc->address,
                    'city' => $lc->city,
                    'number' => $lc->number,
                    'zip_code' => $lc->zip_code,
                    'district' => $lc->district,
                    'complement' => $lc->complement,
                ]);
            }            
        }

        return [
            'id' => $this->User->id,
            'photo_address' => $this->photo_address,
            'email' => $this->User->email,
            'name' => $this->User->name,
            'age' => $this->age,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'about' => $this->about,
            'cpf' => $this->cpf,
            'created_at' => $this->created_at,
            'location' => $location
        ];
    }
}
