<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\RedirectToken;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect to drive Facebook
     *
     * @return mixed
     */
    public function facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Get response data from Facebook and finish sign up
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function facebookCallback()
    {
        $userSocial = Socialite::driver('facebook')->user();

        $email = $userSocial->getEmail();

        // if there is an authenticated user, it links with the user
        if (Auth::check()) {
            $user = auth()->user();
            $user->facebook = $email;
            $user->save();
            return redirect()->json(null, Response::HTTP_OK);
        }

        $user = User::where('facebook', $email);

        // se existir usuário com o email facebook ja vinculado
        if (isset($user->name)) {
            $token = Auth::login($user);
            return RedirectToken::respondWithToken($token);
        }

        // se existir algum usuario com este email
        if (User::where('email', $email)->exists()) {

            $user = User::where('email', $email)->first();
            $user->facebook = $email;
            $user->save();

            $token = Auth::login($user);

            return RedirectToken::respondWithToken($token);
        }

        $user = new User();
        $user->name = $userSocial->getName();
        $user->email = $userSocial->getEmail();
        $user->facebook = $userSocial->getEmail();
        $user->password = bcrypt($userSocial->token);
        $user->save();
        $user->Profile()->create(['nick_name' => $userSocial->getName(), 'photo_address' => $userSocial->getAvatar()]);
        Auth::login($user);
        return redirect()->intended('/user/trip');
    }

    public function entrarGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function retornoGithub()
    {
        $userSocial = Socialite::driver('github')->user();
        $email = $userSocial->getEmail();
        if(Auth::check()){
            $user = auth()->user();
            $user->github = $email;
            $user->save();
            return redirect()->intended('/user/trip');
        }
        $user = User::where('github', $email);
        if(isset($user->name)){
            Auth::login($user);
            return redirect()->intended('/user/trip');
        }
        if(User::where('email', $email)->count()){
            $user = User::where('email', $email)->first();
            $user->github = $email;
            $user->save();
            Auth::login($user);
            return redirect()->intended('/user/trip');
        }
        $user = new User();
        $user->name = $userSocial->getNickname();
        $user->email = $userSocial->getEmail();
        $user->github = $userSocial->getEmail();
        $user->password = bcrypt($userSocial->token);
        $user->save();
        $user->Profile()->create(['name' => $userSocial->getName(), 'photo_address' => $userSocial->getAvatar()]) ;
        Auth::login($user);
        return redirect()->intended('/user/trip');
    }



    public function redirect($service) {
        return Socialite::driver( $service )->redirect();
    }


    public function callback($service) {

        try{
            $userSocial = Socialite::with ( $service )->user();

            $email = $userSocial->getEmail();

            // if there is an authenticated user, it links with the user
            if (Auth::check()) {
                $user = auth()->user();
                $user->email_service = $email;
                $user->driver = $service;
                $user->save();
                return response()->json(null, Response::HTTP_OK);
            }

            $user = User::where($service, $email);

            // se existir usuário com o email $driver ja vinculado
            if (isset($user->name)) {
                $token = Auth::login($user);
                return RedirectToken::respondWithToken($token);
            }

            // se existir algum usuario com este email
            if (User::where('email', $email)->exists()) {

                $user = User::where('email', $email)->first();
                $user->email_service = $email;
                $user->driver = $service;
                $user->save();

                $token = Auth::login($user);

                return RedirectToken::respondWithToken($token);
            }

            $user = $this->createUser($userSocial, $service);

            $this->createProfileUser($user, $userSocial);

            $token = Auth::login($user);
            return RedirectToken::respondWithToken($token);

        }catch (\Exception $e){
            dd($e->getMessage());
            return response()->json(['message' => __('messages.error_default')], Response::HTTP_BAD_GATEWAY);
        }

    }


    private function createUser($userSocial, $service)
    {
        $user = new User();
        $user->name = $userSocial->getName();
        $user->email = $userSocial->getEmail();
        $user->email_service = $userSocial->getEmail();
        $user->driver = $service;
        $user->password = bcrypt($userSocial->token);
        $user->role = 0;
        $user->slug = $userSocial->getName();
        $user->save();
        return $user;
    }

    private function createProfileUser($user, $userSocial)
    {
        $user->Profile()->create([
            'nick_name'     =>  $userSocial->getName(),
            'photo_address' =>  $userSocial->getAvatar(),
            'facebook_link' =>  'https://facebook.com/' . $userSocial->id,
            'twitter_link'  =>  'https://twitter.com/'. $userSocial->getName()
        ]);
    }

}


