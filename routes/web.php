<?php

use App\ServiceRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//testing
Route::get('/mailable', function () {
    $sr = ServiceRequest::find(1);

    return new App\Mail\TripRequested($sr);
});

//public
Route::get('/', 'FrontPageController@index')->name('frontpage');
Route::get('/trips-rates/{slug}', 'ShowServiceController@show');
Route::get('/trip-request', 'TripRequestController@create');
Route::view('/contact', 'StaticPages.contact');
Route::view('/about', 'StaticPages.about');
Route::view('/reviews', 'StaticPages.reviews');
Route::view('/trips-rates', 'StaticPages.services');
Route::view('/albums', 'StaticPages.albums');
Route::get('/albums/{album_id}', 'ShowAlbumController@show');

//dashboard
Route::view('/dashboard', 'dashboard')->middleware('auth');

Route::prefix('api/')->name('api.')->namespace('Backend')->group(function () {
    Route::resource('leads', 'LeadsController');
    Route::get('archivedleads', 'ArchivedLeadsController@index');
    Route::resource('reviews', 'ReviewsController');
    Route::resource('services', 'ServicesController');
    Route::get('featured-services', 'PopularServiceController@index');
    Route::get('featured-reviews', 'FeaturedReviewController@index');
    Route::get('albums', 'AlbumController@index');
    Route::resource('service-requests', 'ServiceRequestsController');
});