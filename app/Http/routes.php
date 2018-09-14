<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
| http://laravel.com/docs/5.1/authentication
| http://laravel.com/docs/5.1/authorization
| http://laravel.com/docs/5.1/routing
| http://laravel.com/docs/5.0/schema
| http://socialiteproviders.github.io/
|
*/

// HOMEPAGE ROUTE
Route::get('/', [
    'uses' 		=> 'IndexController@index'
]);

Route::get('/twitter', function()
{

	return Twitter::getUserTimeline(['screen_name' => 'jeremyekenedy', 'count' => 20, 'format' => 'json']);

    //return Twitter::getHomeTimeline(['count' => 20, 'format' => 'json']);

	//return Twitter::getMentionsTimeline(['count' => 20, 'format' => 'json']);

	//return Twitter::postTweet(['status' => 'Laravel is beautiful', 'format' => 'json']);

});

//Organizations
Route::get('/organizations', 'OrganizationController@all');
Route::get('/organization_all', 'OrganizationController@all');
Route::get('/organization_{id}', 'OrganizationController@find');
Route::post('/organizationprojects_{id}', 'OrganizationController@projects');
Route::post('/organizationservices_{id}', 'OrganizationController@services');
Route::post('/organizationpeoples_{id}', 'OrganizationController@peoples');


Route::post('/organizations_filter', 'OrganizationController@filter');

//Services
Route::get('/services', 'ServiceController@index');
Route::get('/service_all', 'ServiceController@all');
Route::get('/service_{id}', 'ServiceController@find');
Route::post('/organizationservice_{id}', 'ServiceController@find');
Route::post('/services_filter', 'ServiceController@filter');

//Projects
Route::get('/projects', 'ProjectController@projectview');
Route::get('/projects_{id}', 'ProjectController@projectfind');
Route::post('/organizationproject_{id}', 'ProjectController@find');

Route::get('/projecttype_{id}', 'ProjectController@projecttypefind');
Route::get('/projectcategory_{id}', 'ProjectController@category');

Route::post('/projects_filter', 'ProjectController@filter');

//Peoples
Route::get('/people', 'PeopleController@index');
Route::get('/people_{id}', 'PeopleController@find');
Route::post('/organizationpeople_{id}', 'PeopleController@find');

Route::get('/organizationtype_{id}', 'PeopleController@organizationtypefind');

Route::get('/category', [
    'uses' 		=> 'TaxonomyController@all'
]);
Route::get('/category_all', 'TaxonomyController@all');
Route::get('/category_{id}', 'TaxonomyController@find');


Route::get('/location', [
    'uses' 		=> 'LocationController@all'
]);

Route::get('/location_all', 'LocationController@all');
Route::get('/location_{id}', 'LocationController@find');

//find
Route::match(['get', 'post'], '/find', [
    'uses'          => 'IndexController@find'
]);

Route::match(['get', 'post'], '/services_find', [
    'uses'          => 'ServiceController@search'
]);

Route::match(['get', 'post'], '/organizations_find', [
    'uses'          => 'OrganizationController@search'
]);

Route::get('/findorganization_{id}', 'IndexController@findorganization');
Route::get('/findservice_{id}', 'IndexController@findservice');
Route::get('/findproject_{id}', 'IndexController@findproject');
Route::get('/findpeople_{id}', 'IndexController@findpeople');

// ALL AUTHENTICATION ROUTES - HANDLED IN THE CONTROLLERS
Route::controllers([
	'auth' 		=> 'Auth\AuthController',
	'password' 	=> 'Auth\PasswordController',
]);
// REGISTRATION EMAIL CONFIRMATION ROUTES
Route::get('/resendEmail', [
    'as' 		=> 'user',
	'uses'		=> 'Auth\AuthController@resendEmail'
]);
Route::get('/activate/{code}', [
    'as' 		=> 'user',
	'uses'		=> 'Auth\AuthController@activateAccount'
]);



// CUSTOM REDIRECTS
Route::get('restart', function () {
    \Auth::logout();
    return redirect('auth/register')->with('anError',  \Lang::get('auth.loggedOutLocked'));
});


// LARAVEL SOCIALITE AUTHENTICATION ROUTES
Route::get('/social/redirect/{provider}', [
	'as' 		=> 'social.redirect',
	'uses' 		=> 'Auth\AuthController@getSocialRedirect'
]);
Route::get('/social/handle/{provider}',[
	'as' 		=> 'social.handle',
	'uses' 		=> 'Auth\AuthController@getSocialHandle'
]);

// AUTHENTICATION ALIASES/REDIRECTS
Route::get('login', function () {
    return redirect('/auth/login');
});
Route::get('logout', function () {
    return redirect('/auth/logout');
});
Route::get('register', function () {
    return redirect('/auth/register');
});
Route::get('reset', function () {
    return redirect('/password/email');
});
Route::get('admin', function () {
    return redirect('/dashboard');
});
Route::get('home',['uses'=>'IndexController@index']);

Route::get('about',['uses'=>'IndexController@about']);

Route::get('get_involved',['uses'=>'IndexController@get_involved']);

// USER PAGE ROUTES - RUNNING THROUGH AUTH MIDDLEWARE
Route::group(['middleware' => 'auth'], function () {

	// USER DASHBOARD ROUTE
	Route::get('/dashboard', [
	    'as' 		=> 'dashboard',
	    'uses' 		=> 'UserController@index'
	]);

	// USERS VIEWABLE PROFILE
	Route::get('profile/{username}', [
		'as' 		=> '{username}',
		'uses' 		=> 'ProfilesController@show'
	]);
	Route::get('dashboard/profile/{username}', [
		'as' 		=> '{username}',
		'uses' 		=> 'ProfilesController@show'
	]);

	// MIDDLEWARE INCEPTIONED - MAKE SURE THIS IS THE CURRENT USERS PROFILE TO EDIT
	Route::group(['middleware'=> 'currentUser'], function () {
			Route::resource(
				'profile',
				'ProfilesController', [
					'only' 	=> [
						'show',
						'edit',
						'update'
					]
				]
			);
	});

});

// ADMINISTRATOR ACCESS LEVEL PAGE ROUTES - RUNNING THROUGH ADMINISTRATOR MIDDLEWARE
Route::group(['middleware' => 'administrator'], function () {

	// SHOW ALL USERS PAGE ROUTE
	Route::resource('users', 'UsersManagementController');
	Route::get('users', [
		'as' 			=> '{username}',
		'uses' 			=> 'UsersManagementController@showUsersMainPanel'
	]);

	// EDIT USERS PAGE ROUTE
	Route::get('edit-users', [
		'as' 			=> '{username}',
		'uses' 			=> 'UsersManagementController@editUsersMainPanel'
	]);

	// TAG CONTROLLER PAGE ROUTE
	Route::resource('admin/skilltags', 'SkillsTagController', ['except' => 'show']);

	// TEST ROUTE ONLY ROUTE
	Route::get('administrator', function () {
	    echo 'Welcome to your ADMINISTRATOR page '. Auth::user()->email .'.';
	});

	// Home Edit
	Route::get('/home_edit', [
		'as' 			=> '{username}',
		'uses' 			=> 'PostsController@index'
	]);

	Route::get('/about_edit', [
		'as' 			=> '{username}',
		'uses' 			=> 'AboutsController@index'
	]);

	Route::get('/datasync', [
		'as' 			=> '{username}',
		'uses' 			=> 'UserController@datasync'
	]);



	// resource routes for posts
	Route::resource('posts', 'PostsController');

	Route::resource('abouts', 'AboutsController');

	Route::resource('involves', 'InvolvesController');

	//Tables
	Route::resource('tb_projects', 'AdminProjectController');
	Route::resource('tb_commitments', 'AdminCommitmentController');
	Route::resource('tb_expense', 'AdminExpenseController');
	Route::resource('tb_organization', 'AdminAgencyController');
	Route::resource('tb_organizations', 'AdminOrganizationController');
	Route::resource('tb_contacts', 'AdminContactController');
	Route::resource('tb_services', 'AdminServiceController');
	Route::resource('tb_locations', 'AdminLocationController');
	Route::resource('tb_address', 'AdminAddressController');
	Route::resource('tb_phones', 'AdminPhoneController');
	Route::resource('tb_schedule', 'AdminScheduleController');
	Route::resource('tb_programs', 'AdminProgramController');
	Route::resource('tb_taxonomy', 'AdminTaxonomyController');
	Route::resource('tb_details', 'AdminDetailController');

	Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

});

// EDITOR ACCESS LEVEL PAGE ROUTES - RUNNING THROUGH EDITOR MIDDLEWARE
Route::group(['middleware' => 'editor'], function () {

	//TEST ROUTE ONLY
	Route::get('editor', function () {
	    echo 'Welcome to your EDITOR page '. Auth::user()->email .'.';
	});

});

// CATCH ALL ERROR FOR USERS AND NON USERS
Route::any('/{page?}',function(){
	if (Auth::check()) {
	    return view('admin.errors.users404');
	} else {
		return View('errors.404');
	}
})->where('page','.*');

//***************************************************************************************//
//***************************** USER ROUTING EXAMPLES BELOW *****************************//
//***************************************************************************************//

//** OPTION - ALL FOLLOWING ROUTES RUN THROUGH AUTHETICATION VIA MIDDLEWARE **//
/*
Route::group(['middleware' => 'auth'], function () {

	// OPTION - GO DIRECTLY TO TEMPLATE
	Route::get('/', function () {
	    return view('pages.user-home');
	});

	// OPTION - USE CONTROLLER
	Route::get('/', [
	    'as' 			=> 'user',
	    'uses' 			=> 'UsersController@index'
	]);

});
*/
//** OPTION - SINGLE ROUTE USING A CONTROLLER AND AUTHENTICATION VIA MIDDLEWARE **//
/*
Route::get('/', [
    'middleware' 	=> 'auth',
    'as' 			=> 'user',
    'uses' 			=> 'UsersController@index'
]);
*/