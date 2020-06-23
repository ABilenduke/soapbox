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

        Route::get('/articles/drafts', 'ArticleController@drafts');
        Route::get('/articles/published', 'ArticleController@published');
    });

    Route::group([
        'prefix' => 'profile',
        'namespace' => 'Profile'
    ], function () {
        Route::post('/avatar', 'AvatarController@store');
        Route::post('/follow/{user}', 'FollowController@create');
        Route::delete('/follow/{user}', 'FollowController@delete');
    });

    Route::group([
        'prefix' => 'article',
        'namespace' => 'Article'
    ], function () {
        Route::post('/', 'IndexController@create');
        Route::get('/bookmarks', 'BookmarkController@index');
        Route::post('/{id}/publish', 'IndexController@publish');
        Route::post('/{id}/content', 'ContentController@create');
        Route::put('/{id}/content', 'ContentController@update');
        Route::post('/{article}/like', 'IndexController@like');
        Route::post('/{article}/bookmark', 'BookmarkController@create');
    });
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::group(['namespace' => 'Auth'], function () {
        Route::post('login', 'LoginController@login');
        Route::post('register', 'RegisterController@register');

        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'ResetPasswordController@reset');

        Route::post('email/verify/{user}', 'VerificationController@verify')->name('verification.verify');
        Route::post('email/resend', 'VerificationController@resend');
    });
});

Route::get('/users', 'User\IndexController@index');

Route::group([
    'prefix' => 'auth',
    'namespace' => 'Auth'
], function () {
    Route::get('/check/email/{email}', 'CheckUserFieldAvailabilityController@email');
    Route::get('/check/username/{username}', 'CheckUserFieldAvailabilityController@username');
});

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

Route::group([
    'prefix' => 'article',
    'namespace' => 'Article'
], function () {
    Route::get('/', 'IndexController@index');
    Route::get('/{id}', 'IndexController@show');
    Route::get('/{id}/content', 'ContentController@index');
});

Route::get('topcontributors', 'TopContributorsController@index');