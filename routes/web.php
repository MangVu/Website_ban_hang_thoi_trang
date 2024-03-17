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
