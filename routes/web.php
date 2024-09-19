<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index'); //首頁
});

Route::get('/contact', function () {
    return view('contact'); //聯絡我們
});

Route::group(['prefix' => 'product'], function () {
    Route::get('menu', 'App\Http\Controllers\ProductController@Menu')->name('product.menu'); //產品目錄

    Route::get('manage', 'App\Http\Controllers\ProductController@ProductManage')->name('product.manage'); //產品管理
    Route::get('create', 'App\Http\Controllers\ProductController@ProductCreate')->name('product.create'); //新增產品

    Route::group(['prefix' => '{pid}'], function () {
        Route::get('edit', 'App\Http\Controllers\ProductController@ProductEdit'); //編輯產品
        Route::put('/', 'App\Http\Controllers\ProductController@ProductEditProcess'); //編輯處理
        Route::get('delete', 'App\Http\Controllers\ProductController@ProductDeleteProcess'); //刪除產品
    });
});

Route::group(['prefix' => 'user'], function () {
    Route::get('account', 'App\Http\Controllers\UserController@SignUp_Login_Page')->name('user.account'); //註冊 登入
    Route::post('signup', 'App\Http\Controllers\UserController@SignUpProcess'); //註冊處理
    Route::post('login', 'App\Http\Controllers\UserController@LoginProcess');//登入處理
    Route::get('signout', 'App\Http\Controllers\UserController@SignOut')->name('user.signout'); //登出

    Route::get('MemberCenter', 'App\Http\Controllers\UserController@MemberCenter')->name('user.MemberCenter');//會員中心
    Route::get('ManagementCenter', 'App\Http\Controllers\UserController@ManagementCenter')->name('user.ManagementCenter');//管理中心
    Route::get('/orderstate/{oid}/{stype}', 'App\Http\Controllers\UserController@OrderState');//訂單狀態
});

Route::group(['prefix' => 'cart'], function () {
    Route::get('/', 'App\Http\Controllers\CartController@CartPage')->name('cart');
    Route::post('menu', 'App\Http\Controllers\CartController@CartAddProcess')->name('cart.add'); //新增商品
    Route::post('update', 'App\Http\Controllers\CartController@CartUpdateProcess'); //商品更新
    Route::get('/{cid}/delete', 'App\Http\Controllers\CartController@CartDeleteProcess'); //刪除

    Route::post('submit', 'App\Http\Controllers\CartController@CartSubmitProcess'); //送出訂單
});
