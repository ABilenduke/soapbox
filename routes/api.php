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
Route::get('/profile/user/{username}', 'Profile\UserController@show');

Route::get('/auth/check/email/{email}', 'Auth\CheckUserFieldAvailabilityController@email');
Route::get('/auth/check/username/{username}', 'Auth\CheckUserFieldAvailabilityController@username');

Route::get('profile/following/{username}', 'Profile\FollowController@following');
Route::get('profile/followers/{username}', 'Profile\FollowController@followers');

Route::get('categories', 'CategoryController@index');

Route::get('articles', 'ArticleController@index');
Route::get('article/{id}', 'ArticleController@show');
Route::get('article/{id}/content', 'ArticleContentController@index');

Route::get('topcontributors', 'TopContributorsController@index');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');
    Route::get('/user', 'UserController@show');
    Route::patch('/user', 'UserController@update');

    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');

    Route::post('profile/avatar', 'Profile\AvatarController@store');

    Route::post('profile/follow/{username}', 'Profile\FollowController@create');
    Route::delete('profile/follow/{username}', 'Profile\FollowController@delete');

    Route::get('user/articles/drafts', 'User\ArticleController@drafts');
    Route::get('user/articles/published', 'User\ArticleController@published');

    Route::post('article', 'ArticleController@create');

    Route::post('article/{id}/publish', 'ArticleController@publish');

    Route::post('article/{id}/content', 'ArticleContentController@create');
    Route::patch('article/content/{id}', 'ArticleContentController@update');
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});
