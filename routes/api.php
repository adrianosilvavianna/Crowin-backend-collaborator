<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group(['prefix' => 'auth'], function () {

    //Rotas de autenticação
    Route::post('login',                    'AuthController@login')                         ->name('auth.login');
    Route::post('logout',                   'AuthController@logout')                        ->name('auth.login');
    Route::post('refresh',                  'AuthController@refresh')                       ->name('auth.refresh');
    Route::post('me',                       'AuthController@me')                            ->name('auth.me');
    Route::post('register',                 'AuthController@signUp')                        ->name('auth.refresh');

    Route::get('/facebook',                 'SocialAuthController@facebook')                ->name('auth.facebook');
    Route::get('/facebook/callback',        'SocialAuthController@facebookCallback')        ->name('auth.facebookCallback');

    Route::get('/github',                   'SocialAuthController@github')                  ->name('auth.github');
    Route::get('/github/callback',          'SocialAuthController@githubCallback')          ->name('auth.githubCallback');

    Route::get('/google',                   'SocialAuthController@google')                  ->name('auth.google');
    Route::get('/google/callback',          'SocialAuthController@google')                  ->name('auth.googleCallback');
});

Route::group(['middleware' => 'jwt'], function (){

    Route::group(['prefix' => 'profile'], function () {
        Route::post('/index',                'ProfileController@index')                     ->name('profile.index');
        Route::get('/show/{profile}',        'ProfileController@show')                       ->name('profile.show');
        Route::post('/store',                'ProfileController@store')                     ->name('profile.store');
        Route::put('/update/{profile}',      'ProfileController@update')                    ->name('profile.update');
        Route::delete('/delete/{profile}',   'ProfileController@delete')                    ->name('profile.delete');

    });

    Route::group(['prefix' => 'location'], function () {
        Route::post('/index',                'LocationController@index')                    ->name('location.index');
        Route::get('/show/{location}',       'LocationController@index')                     ->name('location.show');
        Route::post('/store',                'LocationController@store')                    ->name('location.store');
        Route::put('/update/{location}',     'LocationController@update')                   ->name('location.update');
        Route::delete('/delete/{location}',  'LocationController@delete')                   ->name('location.delete');
    });

    Route::group(['prefix' => 'auction'], function () {
        Route::post('/index',                'AuctionController@index')                     ->name('auction.index');
        Route::get('/show/{auction}',        'AuctionController@index')                       ->name('auction.show');
    });

});








