<?php

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

//backend part here
Route::name('admin.')->group(function () {
    Route::group(['prefix' => 'dashboard', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
        Route::get('/', 'HomeController@index')->name('index');

        Route::resource('company', 'CompanyController');

        Route::resource('usergroup', 'UsergroupController');
        Route::get('usergroup/status/{id}', 'UsergroupController@status')->name('usergroup.status');
        Route::get('usergroup/permission/{id}', 'UsergroupController@permission')->name('usergroup.permission');
        Route::post('usergroup/permission/{id}', 'UsergroupController@permission')->name('permission.update');
       
        Route::resource('user', 'UserController');
        Route::delete('user/{user?}', 'UserController@destroy')->name('user.destroy');
        Route::get('user/profile/{id}', 'UserController@profile')->name('user.profile');
        Route::get('user/status/{id}', 'UserController@status')->name('user.status');

        Route::resource('page', 'PageController');
        Route::get('page/status/{id}', 'PageController@status')->name('page.status');
        Route::delete('page/{id?}', 'PageController@destroy')->name('page.destroy');

        Route::resource('banner', 'BannerController');
        Route::get('banner/status/{id}', 'BannerController@status')->name('banner.status');
        Route::delete('banner/{banner?}', 'BannerController@destroy')->name('banner.destroy');

        Route::resource('news', 'NewsController');
        Route::get('news/status/{id}', 'NewsController@status')->name('news.status');
        Route::delete('news/{news?}', 'NewsController@destroy')->name('news.destroy');

        Route::resource('gallery', 'GalleryController');
        Route::get('gallery/status/{id}', 'GalleryController@status')->name('gallery.status');
        Route::delete('gallery/{gallery?}', 'GalleryController@destroy')->name('gallery.destroy');
        
        Route::name('contact.')->group(function () {
            Route::get('contact/show/{contact}', 'ContactController@show')->name('show');
            Route::get('contact', 'ContactController@index')->name('index');
            Route::delete('contact/{contact?}', 'ContactController@destroy')->name('destroy');
            // Route::get('contact/export', 'ContactController@export')->name('export');
        });

        Route::resource('testimonial', 'TestimonialController');
        Route::get('testimonial/status/{id}', 'TestimonialController@status')->name('testimonial.status');
        Route::delete('testimonial/{testimonial?}', 'TestimonialController@destroy')->name('testimonial.destroys');
        Route::delete('testimonial/file/remove', "TestimonialController@deleteimg")->name('testimonial.deleteimg');

    });

});

Route::group(['prefix' => 'dashboard', 'namespace' => 'Admin'], function () {
    Auth::routes();
    Route::post('/login', 'Auth\LoginController@login')->name('login')->middleware('authcheckstatus');
});

Route::get('/', 'HomeController@index')->name('index');

Route::get('/photo-gallery', "GalleryController@photo")->name('photo-gallery');

Route::get('/video-gallery', 'GalleryController@video')->name('video-gallery');

Route::get('/news', 'NewsController@index')->name('news');

Route::get('/news/{slug}', 'NewsController@details')->name('news.show');

Route::get('/contact-us', 'ContactController@index')->name('contact-us');

Route::post('/contact-us', 'ContactController@send')->name('contact-us.send');

Route::get('/testimonial', 'TestimonialController@index')->name('testimonial');

Route::post('/testimonial', 'TestimonialController@send')->name('testimonial.send');

Route::get('/{name}', "HomeController@page")->name('page')->where('name', '[A-Za-z-]+');