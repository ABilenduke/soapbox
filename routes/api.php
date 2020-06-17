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

Route::get('/users', 'UserController@index');

Route::get('/auth/check/email/{email}', 'Auth\CheckUserFieldAvailabilityController@email');
Route::get('/auth/check/username/{username}', 'Auth\CheckUserFieldAvailabilityController@username');

Route::group([
    'prefix' => 'profile',
    'namespace' => 'Profile'
], function () {
    Route::get('user/{user}', 'UserController@show');
    Route::get('following/{user}', 'FollowController@following');
    Route::get('followers/{user}', 'FollowController@followers');
    Route::get('activity/{user}', 'ActivityController@index');
});

Route::get('categories', 'CategoryController@index');

Route::get('articles', 'ArticleController@index');
Route::get('article/{id}', 'ArticleController@show');
Route::get('article/{id}/content', 'ArticleContentController@index');

Route::get('topcontributors', 'TopContributorsController@index');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::group([
        'prefix' => 'user',
        'namespace' => 'User'
    ], function () {
        Route::get('/', 'IndexController@show');
        Route::put('/', 'IndexController@update');

        Route::get('/settings', 'SettingsController@index');
        Route::get('/settings/{setting}', 'SettingsController@show');
        Route::put('/settings', 'SettingsController@update');
    });

    Route::post('profile/avatar', 'Profile\AvatarController@store');

    Route::post('profile/follow/{user}', 'Profile\FollowController@create');
    Route::delete('profile/follow/{user}', 'Profile\FollowController@delete');

    Route::get('user/articles/drafts', 'User\ArticleController@drafts');
    Route::get('user/articles/published', 'User\ArticleController@published');

    Route::post('article', 'ArticleController@create');

    Route::post('article/{id}/publish', 'ArticleController@publish');

    Route::post('article/{id}/content', 'ArticleContentController@create');
    Route::put('article/content/{id}', 'ArticleContentController@update');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');
});
