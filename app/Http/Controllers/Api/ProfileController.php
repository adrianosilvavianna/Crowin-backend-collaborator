<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    protected $profile;

    /**
     * ProfileController constructor.
     */
    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        try{
            if(isset(auth()->user()->Profile)){
                return ProfileResource::collection(auth()->user()->Profile);
            }
            throw new \Exception(__('messages.not_data'));
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], Response::HTTP_OK);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        try{
            auth()->user()->Profile()->create($request->all());
            return response(__('messages.updated'), Response::HTTP_CREATED);
        }catch (\Exception $e){
            return response()->json(['message' => __('messages.error_default')], Response::HTTP_BAD_GATEWAY);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile $profile
     * @return ProfileResource
     */
    public function show(Profile $profile)
    {
       return new ProfileResource($profile);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, Profile $profile)
    {
			try{
				$profile->update($request->all());
        return response(__('messages.updated'), Response::HTTP_ACCEPTED);
			}catch (\Exception $e){
					return response()->json(['message' => __('messages.error_default')], Response::HTTP_BAD_GATEWAY);
			}
		}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return response(['message' => __('messages.deleted')], Response::HTTP_NO_CONTENT);
    }
}
