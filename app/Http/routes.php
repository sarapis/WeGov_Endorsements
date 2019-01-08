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

Route::get('/organization_{id}/projects', 'OrganizationController@projects');
Route::get('/organization_{id}/services', 'OrganizationController@services');
Route::get('/organization_{id}/people', 'OrganizationController@peoples');
Route::get('/organization_{id}/money', 'OrganizationController@money');
Route::get('/organization_{id}/laws', 'OrganizationController@laws');
Route::get('/organization_{id}/legislation', 'OrganizationController@legislation');
Route::get('/organization_{id}', 'OrganizationController@find');

Route::post('/organizations_filter', 'OrganizationController@filter');
Route::post('/organizations_search', 'OrganizationController@search');

//Services
Route::get('/services', 'ServiceController@index');
Route::get('/service_all', 'ServiceController@all');
Route::get('/services/{id}', 'ServiceController@service');
Route::post('/organizationservice_{id}', 'ServiceController@servicefind');
Route::get('/organization_{id}/services/{service_id}', 'ServiceController@find');
Route::post('/services_filter', 'ServiceController@filter');
Route::post('/services_search', 'ServiceController@search');

//Projects
Route::get('/projects', 'ProjectController@projectview');
Route::get('/projects/{id}', 'ProjectController@project');
Route::post('/organizationproject_{id}', 'ProjectController@projectfind');
Route::get('/organization_{id}/projects/{project_id}', 'ProjectController@find');


Route::get('/projecttype_{id}', 'ProjectController@projecttypefind');
Route::get('/projectcategory_{id}', 'ProjectController@category');

Route::post('/projects_filter', 'ProjectController@filter');

Route::post('/projects_search', 'ProjectController@search');

//Peoples
Route::get('/people', 'PeopleController@index');
Route::get('/people_{id}', 'PeopleController@find');
Route::get('/organization_{id}/people/{people_id}', 'PeopleController@find');

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
Route::get('/home',['uses'=>'IndexController@index']);

Route::get('/about',['uses'=>'IndexController@about']);

Route::get('/data',['uses'=>'IndexController@data']);

Route::get('/laws',['uses'=>'IndexController@law']);

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

	Route::get('/data_edit', [
		'as' 			=> '{username}',
		'uses' 			=> 'DataController@index'
	]);

	Route::get('/datasync', [
		'as' 			=> '{username}',
		'uses' 			=> 'UserController@datasync'
	]);

	// Route::get('/sync_address', ['uses' => 'AdminAddressController@airtable']);
	// Route::get('/sync_contacts', ['uses' => 'AdminContactController@airtable']);
	Route::get('/sync_organizations', ['uses' => 'AdminOrganizationController@airtable']); 
	// Route::get('/sync_phones', ['uses' => 'AdminPhoneController@airtable']);
	// Route::get('/sync_tags', ['uses' => 'AdminTagController@airtable']);  
	
	Route::get('/sync_projects', ['uses' => 'AdminProjectController@airtable']);
	Route::get('/sync_commitments', ['uses' => 'AdminCommitmentController@airtable']);
	Route::get('/sync_expenses', ['uses' => 'AdminExpenseController@airtable']); 
	Route::get('/sync_organization', ['uses' => 'AdminAgencyController@airtable']);
	Route::get('/sync_services', ['uses' => 'AdminServiceController@airtable']);
	Route::get('/sync_locations', ['uses' => 'AdminLocationController@airtable']); 
	Route::get('/sync_services_organizations', ['uses' => 'AdminServiceOrganizationController@airtable']); 
	Route::get('/sync_contact', ['uses' => 'AdminServiceContactController@airtable']);
	Route::get('/sync_services_phones', ['uses' => 'AdminServicePhoneController@airtable']); 
	Route::get('/sync_services_address', ['uses' => 'AdminServiceAddressController@airtable']);
	Route::get('/sync_schedule', ['uses' => 'AdminScheduleController@airtable']);
	Route::get('/sync_service_area', ['uses' => 'AdminServiceAreaController@airtable']); 
	Route::get('/sync_taxonomy', ['uses' => 'AdminTaxonomyController@airtable']); 
	Route::get('/sync_details', ['uses' => 'AdminDetailController@airtable']);

	Route::get('/sync_greenbook', ['uses' => 'AdminGreenbookController@greenbook']);

	
	Route::get('/sync_politician_organizations', ['uses' => 'AdminPoliticianOrganizationController@airtable']);   
	Route::get('/sync_politicians', ['uses' => 'AdminPoliticianController@airtable']); 
	Route::get('/sync_campaigns', ['uses' => 'AdminCampaignController@airtable']);
	Route::get('/sync_endorsements', ['uses' => 'AdminEndorsementController@airtable']);
	Route::get('/sync_offices', ['uses' => 'AdminOfficeController@airtable']);
	Route::get('/sync_elections', ['uses' => 'AdminElectionController@airtable']);
	Route::get('/sync_parties', ['uses' => 'AdminPartyController@airtable']);
	Route::get('/sync_politician_source', ['uses' => 'AdminPoliticianSourceController@airtable']);
	Route::get('/sync_general_information', ['uses' => 'AdminInformationController@airtable']);
	Route::get('/sync_city_positions', ['uses' => 'AdminPositionController@airtable']);
	Route::get('/sync_other_noncity_income', ['uses' => 'AdminNoncityController@airtable']);
	Route::get('/sync_list_of_money_you_owe', ['uses' => 'AdminMoneyController@airtable']);
	Route::get('/sync_real_estate', ['uses' => 'AdminRealEstateController@airtable']);
	Route::get('/sync_securities', ['uses' => 'AdminSecuritiesController@airtable']);
	Route::get('/sync_trust', ['uses' => 'AdminTrustController@airtable']);
	Route::get('/sync_relatives', ['uses' => 'AdminRelativesController@airtable']);




	// resource routes for posts
	Route::resource('posts', 'PostsController');

	Route::resource('abouts', 'AboutsController');

	Route::resource('involves', 'InvolvesController');

	Route::resource('datas', 'DataController');

	Route::resource('law', 'LawController');

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

	Route::resource('tb_greenbook', 'AdminGreenbookController');

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