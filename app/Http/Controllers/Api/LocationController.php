<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Models\Location;
use Illuminate\Http\Response;

class LocationController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        try {
            auth()->user()->Locations()->create($request->all());
            return response(__('messages.created'), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['message' => __('messages.error_default')], Response::HTTP_BAD_GATEWAY);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, Location $location)
    {
        try{
            $location->update($request->all());
            return response(__('messages.updated'), Response::HTTP_OK);
        }catch (\Exception $e) {
            return response()->json(['message' => __('messages.error_default')], Response::HTTP_BAD_GATEWAY);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function delete(Location $location)
    {
        try{
            $location->delete();
            return response(__('messages.deleted'), Response::HTTP_OK);
        }catch (\Exception $e) {
            return response()->json(['message' => __('messages.error_default')], Response::HTTP_BAD_GATEWAY);
        }

    }
}
