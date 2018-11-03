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



Route::group(['middleware' => ['web'], 'prefix' => 'auth'], function () {

    //Rotas de autenticação
    Route::post('login',                    'AuthController@login')                         ->name('auth.login');
    Route::post('logout',                   'AuthController@logout')                        ->name('auth.logout');
    Route::post('refresh',                  'AuthController@refresh')                       ->name('auth.refresh');
    Route::post('me',                       'AuthController@me')                            ->name('auth.me');
    Route::get('register/',                 'AuthController@signUp')                        ->name('auth.refresh');
    Route::post('register',                 'AuthController@signUp')                        ->name('auth.refresh');

    Route::get ( '/redirect/{service}', 'SocialAuthController@redirect' )->name('api.auth.redirect');
    Route::get ( '/callback/{service}', 'SocialAuthController@callback' )->name('api.auth.callback');
});

Route::group(['middleware' => 'jwt'], function (){

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/index',                'ProfileController@index')                     ->name('profile.index');
        Route::get('/show/{profile}',        'ProfileController@show')                       ->name('profile.show');
        Route::post('/store',                'ProfileController@store')                     ->name('profile.store');
        Route::put('/update/{profile}',      'ProfileController@update')                    ->name('profile.update');
        Route::delete('/delete/{profile}',   'ProfileController@delete')                    ->name('profile.delete');

    });

    Route::group(['prefix' => 'location'], function () {
        Route::get('/index',                'LocationController@index')                    ->name('location.index');
        Route::get('/show/{location}',       'LocationController@index')                     ->name('location.show');
        Route::post('/store',                'LocationController@store')                    ->name('location.store');
        Route::put('/update/{location}',     'LocationController@update')                   ->name('location.update');
        Route::delete('/delete/{location}',  'LocationController@delete')                   ->name('location.delete');
    });

    Route::group(['prefix' => 'auction'], function () {
        Route::get('/index',                'AuctionController@index')                     ->name('auction.index');
        Route::get('/show/{auction}',       'AuctionController@show')                       ->name('auction.show');
    });

    Route::group(['prefix' => 'favorite'], function () {
        Route::get('/change/{auction}',                'FavoriteAuctionController@toChange')                     ->name('auction.change');
    });

    Route::group(['prefix' => 'bids'], function () {
        Route::get('/history',                'BidController@history')                     ->name('bid.history');
        Route::get('/totalBids',              'BidController@getCountBids')                ->name('bid.getCountBids');
    });

});
