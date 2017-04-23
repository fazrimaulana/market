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

Route::get('/', function () {
    $categories = App\Categories::all();
    return view('welcome', [
            "categories" => $categories
        ]);
});

Auth::routes();

/*Route::get('/home', 'HomeController@index');*/

	$backend = [
    	'prefix' => 'dashboard',
	];

	Route::group($backend, function () {

		/**
    	 * -----------------------------------------
     	* Dashboard
     	* -----------------------------------------
     	*/
    	Route::get('/', 'DashboardController@index');

    	/**
     	* -----------------------------------------
     	* Users
     	* -----------------------------------------
     	*/
    	Route::get('/users', 'UserController@index');
        Route::post('/users', 'UserController@store');
        Route::get('/users/edit/{user}', 'UserController@getData');
        Route::patch('/users/edit', 'UserController@update');
        Route::delete('/users/delete', 'UserController@delete');
        Route::get('/users/view/{user}', 'UserController@profile');
        Route::post('/users/change/password', 'UserController@changePassword');
        /*Route::get('/users/admin', 'UserController@admin');
        Route::get('/users/seller', 'UserController@seller');
        Route::get('/users/buyer', 'UserController@buyer');*/

        /**
        * -----------------------------------------
        * Product
        * -----------------------------------------
        */
        Route::get('/product', 'ProductController@index');
        Route::get('/product/add', 'ProductController@add');
        Route::post('/product/add', 'ProductController@store');
        Route::get('/product/{product}/edit', 'ProductController@getData');
        Route::post('/product/{product}/edit', 'ProductController@update');
        Route::delete('/product/delete', 'ProductController@delete');
        Route::delete('/product/gallery/delete', 'ProductController@deleteGallery');
        Route::get('/product/{p_id}/gallery_set_utama/{g_id}', 'ProductController@edit_set_utama');
        Route::get('/product/{product}/view', 'ProductController@view');

        /**
        * -----------------------------------------
        * Categories
        * -----------------------------------------
        */
        Route::get('/categories', 'CategoriesController@index');
        Route::post('/categories/add', 'CategoriesController@store');
        Route::get('/categories/{category}/edit', 'CategoriesController@getAjaxData');
        Route::post('/categories/edit', 'CategoriesController@update');
        Route::delete('/categories/delete', 'CategoriesController@delete');

        /**
        * -----------------------------------------
        * Sub Categories
        * -----------------------------------------
        */
        Route::get('/sub_categories', 'SubCategoriesController@index');
        Route::post('/sub_categories/add', 'SubCategoriesController@store');
        Route::get('/sub_categories/{sub_category}/edit', 'SubCategoriesController@getAjaxData');
        Route::post('/sub_categories/edit', 'SubCategoriesController@update');
        Route::delete('/sub_categories/delete', 'SubCategoriesController@delete');
        Route::get('/sub_categories/get/{id}', 'SubCategoriesController@getSubCategoriesAjax');
        Route::get('/sub_categories/get/{id}/{product}', 'SubCategoriesController@getSubCategories');

        /**
        * -----------------------------------------
        * Gallery
        * -----------------------------------------
        */
        Route::get('/gallery', 'GalleryController@index');
        Route::get('/gallery/add', 'GalleryController@add');
        Route::post('/gallery/add', 'GalleryController@store');
        Route::put('/gallery/edit', 'GalleryController@update');
        Route::delete('/gallery/delete', 'GalleryController@delete');
        Route::get('/gallery/{lastid}/set_utama/{id}', 'GalleryController@setUtama');

        /**
        * -----------------------------------------
        * Role
        * -----------------------------------------
        */
        Route::get('/role', 'RoleController@index');
        Route::post('/role/add', 'RoleController@store');
        Route::get('/role/{role}/edit', 'RoleController@getData');
        Route::post('/role/edit', 'RoleController@update');
        Route::delete('/role/delete', 'RoleController@delete');
        Route::get('/role/{role}/view', 'RoleController@view');
        Route::post('/role/adduser', 'RoleController@adduser');
        Route::delete('/role/deleteuser', 'RoleController@deleteuser');
        Route::post('/role/addpermission', 'RoleController@addpermission');
        Route::delete('/role/deletepermission', 'RoleController@deletepermission');

        /**
        * -----------------------------------------
        * Permission
        * -----------------------------------------
        */
        Route::get('/permission', 'PermissionController@index');
        Route::post('permission/add', 'PermissionController@store');
        Route::get('/permission/{permission}/edit', 'PermissionController@getData');
        Route::post('/permission/edit', 'PermissionController@update');
        Route::delete('/permission/delete', 'PermissionController@delete');


        /**
        * -----------------------------------------
        * Company
        * -----------------------------------------
        */
        Route::get('/company', 'CompanyController@index');
        Route::post('/company/add', 'CompanyController@store');
        Route::get('/company/{company}/edit', 'CompanyController@getData');
        Route::post('/company/edit', 'CompanyController@update');
        Route::delete('/company/delete', 'CompanyController@delete');

	});


