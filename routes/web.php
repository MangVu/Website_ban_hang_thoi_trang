<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin', 'AdminController@loginAdmin');

Route::post('/admin ', 'AdminController@postloginAdmin');
  
Route::get('/home', function () {
    return view('home');
});

Route::prefix('admin')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as' => 'categories.index', 
            'uses' => 'CategoryController@index' 
        ]);
        Route::get('/create', [
            'as' => 'categories.create', 
            'uses' => 'CategoryController@create' 
        ]);
        Route::post('/store', [
            'as' => 'categories.store', 
            'uses' => 'CategoryController@store' 
        ]);
        Route::get('/edit/{id}', [
            'as' => 'categories.edit', 
            'uses' => 'CategoryController@edit' 
        ]);
        //update sau khi bam submit
        Route::post('/update/{id}', [
            'as' => 'categories.update', 
            'uses' => 'CategoryController@update' 
        ]);
        Route::get('/delete/{id}', [
            'as' => 'categories.delete', 
            'uses' => 'CategoryController@delete' 
        ]);
    });
    
    Route::prefix('menus')->group(function () {
        Route::get('/', [
            'as' => 'menus.index', 
            'uses' => 'MenuController@index' 
        ]);
        Route::get('/create', [
            'as' => 'menus.create', 
            'uses' => 'MenuController@create' 
        ]);
        Route::post('/store', [
            'as' => 'menus.store', 
            'uses' => 'MenuController@store' 
        ]);
        Route::get('/edit/{id}', [
            'as' => 'menus.edit', 
            'uses' => 'MenuController@edit' 
        ]);
        //update sau khi bam submit
        Route::post('/update/{id}', [
            'as' => 'menus.update', 
            'uses' => 'MenuController@update' 
        ]);
        Route::get('/delete/{id}', [
            'as' => 'menus.delete', 
            'uses' => 'MenuController@delete' 
        ]);
    
    });
    //product
    Route::prefix('product')->group(function () {
        Route::get('/', [
            'as' => 'product.index', 
            'uses' => 'AdminProductController@index' 
        ]);
        Route::get('/create', [
            'as' => 'product.create', 
            'uses' => 'AdminProductController@create' 
        ]);
        Route::post('/store', [
            'as' => 'product.store', 
            'uses' => 'AdminProductController@store' 
        ]);
        Route::get('/edit/{id}', [
            'as' => 'product.edit', 
            'uses' => 'AdminProductController@edit' 
        ]);
        Route::post('/update/{id}', [
            'as' => 'product.update', 
            'uses' => 'AdminProductController@update' 
        ]);
        Route::get('/delete/{id}', [
            'as' => 'product.delete', 
            'uses' => 'AdminProductController@delete' 
        ]);
    });
    //Slider: quản lí các hình ảnh trượt 
    Route::prefix('slider')->group(function () {
        Route::get('/', [
            'as' => 'slider.index', 
            'uses' => 'SliderAdminController@index' 
        ]);
        Route::get('/create', [
            'as' => 'slider.create', 
            'uses' => 'SliderAdminController@create' 
        ]);
        Route::post('/store', [
            'as' =>'slider.store', 
            'uses' => 'SliderAdminController@store' 
        ]);
        Route::get('/edit/{id}', [
            'as' =>'slider.edit', 
            'uses' => 'SliderAdminController@edit' 
        ]);
        Route::post('/update/{id}', [
            'as' => 'slider.update', 
            'uses' => 'SliderAdminController@update' 
        ]);
        Route::get('/delete/{id}', [
            'as' =>'slider.delete', 
            'uses' => 'SliderAdminController@delete' 
        ]);
    });
    //Setting: quản lí các link facebook, twitter, sdt,....
    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as' => 'settings.index', 
            'uses' => 'AdminSettingController@index' 
        ]);
        Route::get('/create', [
            'as' => 'settings.create', 
            'uses' => 'AdminSettingController@create' 
        ]);
        Route::post('/store', [
            'as' => 'settings.store', 
            'uses' => 'AdminSettingController@store' 
        ]);
        Route::get('/edit/{id}', [
            'as' => 'settings.edit', 
            'uses' => 'AdminSettingController@edit' 
        ]); 
        Route::post('/update/{id}', [
            'as' => 'settings.update', 
            'uses' => 'AdminSettingController@update' 
        ]); 
        Route::get('/delete/{id}', [
            'as' => 'settings.delete', 
            'uses' => 'AdminSettingController@delete' 
        ]);       
    });
    //user
    Route::prefix('users')->group(function () {
        Route::get('/', [
            'as' => 'users.index', 
            'uses' => 'AdminUserController@index' 
        ]);
        Route::get('/create', [
            'as' => 'users.create', 
            'uses' => 'AdminUserController@create' 
        ]);
        Route::post('/store', [
            'as' => 'users.store', 
            'uses' => 'AdminUserController@store' 
        ]);
        Route::get('/edit/{id}', [
            'as' => 'users.edit', 
            'uses' => 'AdminUserController@edit' 
        ]);
        Route::post('/update/{id}', [
            'as' => 'users.update', 
            'uses' => 'AdminUserController@update' 
        ]);
        Route::get('/delete/{id}', [
            'as' => 'users.delete', 
            'uses' => 'AdminUserController@delete' 
        ]);
    });
    //
    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as' => 'roles.index', 
            'uses' => 'AdminRoleController@index' 
        ]);
        Route::get('/create', [
            'as' => 'roles.create', 
            'uses' => 'AdminRoleController@create' 
        ]);
        Route::post('/store', [
            'as' => 'roles.store', 
            'uses' => 'AdminRoleController@store' 
        ]);
        
    });
});






/*Route::get('/', function () {
    $html = '<h1>Học lập trình</h1>';
    return $html;
    return ('home page');
});
//'/' là không bắt buộc nếu sau url chỉ có 1 sược
Route::get('unicode', function () {
    return 'phương thức post';
});
//Phương thức POST thì phải dùng form
Route::get('/unicode', function(){
    return view('demo');
});*/
