<?php

//user Resource
// Route::get('users', array('as' => 'users', 'uses' => 'users@index'));
// Route::get('users/(:any)', array('as' => 'users', 'uses' => 'users@show'));
Route::get('users/new', array('as' => 'new_user', 'uses' => 'users@new'));
// Route::get('users/(:any)/edit', array('as' => 'edit_user', 'uses' => 'users@edit'));
// Route::post('users', 'users@create');
// Route::put('users/(:any)', 'users@update');
// Route::delete('users/(:any)', 'users@destroy');

//jack@gmail.com, abc
//When non users try to access user pages they will be denied.
Route::get('users', array('before' => 'auth', function() {
    $user = Auth::user();
	
	if($user)
	{
		//To delete all websites
		//User::find(3)->websites()->delete();
		//return 'done deleting';
		
		//To insert a website in liquidalloy
		// User::find(3)->websites()->insert(array(
		// 	'url' => 'http://google.ca'
		// 	));
		// return 'done inserting';

		//To print the websites for a specific user
		// $user_id = User::find($user->id);
		// $websites = Website::find($user_id);
		// dd($websites);
		// return 'done finding';
		// return View::make('user.index')->with(array(
		// 	'email' => $user->email,
		// 	'websites' => $websites
		// ));
		
		// If user is logging in from homepage then dont run insertion code below. 
		// Database insertion
gfdgfd
		$u_id = $user->id;
        $sites = Website::where('user_id', '=', $u_id)->get();

        //Count the number of elements a user has stored
        $num_sites = count($sites);
        

        return View::make('user.index')->with(array(
                       'sites' => $sites,
                       'email' => $user->email,
                       'num_sites' => $num_sites
       ));
	}

	return 'You do not have permission to view this page. Log in first. ' . HTML::link('/', 'login' );
}));


Route::controller(Controller::detect()); 

Route::get('logout', function(){
	Auth::logout();
	return 'logged out';
	//Usually this redirect to a login form
});

/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application. The exception object
| that is captured during execution is then passed to the 500 listener.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function($exception)
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	// if (Auth::guest()) return Redirect::to('/');
});