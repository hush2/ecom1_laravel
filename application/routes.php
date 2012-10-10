<?php

// Make URLs similar to the original.

Route::get('/', 'home@index');
Route::post('/', 'account@login');
Route::get('category/(:num)', 'content@category');
Route::get('page/(:num)', 'content@page');
Route::get('pdfs', 'content@pdfs');
Route::get('view_pdf/(:any)', 'content@view_pdf');
Route::get('about', 'home@about');
Route::get('contact', 'home@contact');

Route::group(array('before' => 'auth'), function()
{
    Route::get('logout', 'account@logout');
    Route::any('change_password', 'account@change_password');
    Route::get('renew', 'account@renew');
    Route::get('history', 'account@history');
    Route::get('add_to_favorites/(:num)', 'content@add_to_favorites');
    Route::get('remove_from_favorites/(:num)', 'content@remove_from_favorites');
    Route::get('favorites', 'content@favorites');
    Route::get('history', 'content@history');
});

Route::group(array('before' => 'auth|admin'), function()
{
    Route::any('add_page', 'admin@add_page');
    Route::any('add_pdf', 'admin@add_pdf');
});

Route::group(array('before' => 'member'), function()
{
    Route::any('register',  'account@register');
    Route::any('forgot_password',  'account@forgot_password');
});

View::composer(array('base'), function($view)
{
    $view->categories = Category::all();
});

//-------------------------------------------------------------------------
// Application 404 & 500 Error Handlers
//--------------------------------------------------------------------------
Event::listen('403', function($message='Forbidden')
{
    return Response::error('403', array('message' => $message));
});

Event::listen('404', function()
{
    return Response::error('404');
});

Event::listen('500', function($message='')
{
    return Response::error('500', array('message' => $message));
});

//--------------------------------------------------------------------------
// Route Filters
//--------------------------------------------------------------------------
Route::filter('before', function()
{
});

Route::filter('after', function($response)
{
});

Route::filter('csrf', function()
{
    if (Request::forged())
    {
        return Response::error('500');
    }
});

Route::filter('auth', function()
{
    if (Auth::guest())
    {
        return Event::first('403', 'Logged in users only.');
    }
});

Route::filter('admin', function()
{
    if (Auth::user()->type !== 'admin')
    {
        return Event::first('403', 'Admin access only.');
    }
});

Route::filter('member', function()
{
    if (! Auth::guest())
    {
        return Redirect::to('/');
    }
});