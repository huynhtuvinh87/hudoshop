<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'Front\HomeController@index');
Route::get('test', 'Front\HomeController@resize');
Route::get('image/{path}', function ($path) {
    return $path;
});
Route::get('/s/{code}', 'Front\ProductController@getLink');
Route::get('/home', 'Front\HomeController@index')->name('home');
Route::post('/forgot', 'Api\ForgotPasswordController@index')->name('forgot');
Route::post('/updatePassword', 'Api\ForgotPasswordController@updatePassword')->name('updatePassword');
Route::get('p/{slug}-{id}', 'Front\PageController@view')
    ->where('slug', '.*?')
    ->where('id', '\d+');
Route::get('a/{slug}-{id}', 'Front\PageController@viewAfl')
    ->where('slug', '.*?')
    ->where('id', '\d+');
Route::get('f/{code}', 'Front\PageController@getLink');
Route::get('{slug}-{id}', 'Front\ProductController@detail')
    ->where('slug', '.*?')
    ->where('id', '\d+');

Route::get('/filter', 'Front\ProductController@filter');
Route::get('/category/{slug}', 'Front\ProductController@category');
Route::post('/cart/add', 'Front\CartController@add');
Route::post('/cart/update', 'Front\CartController@update');
Route::get('/cart/checkout', 'Front\CartController@checkout')->name('checkout');
Route::post('/cart/remove', 'Front\CartController@remove');
Route::post('/cart/order', 'Front\CartController@order')->name('order');
Route::get('/order/success', 'Front\CartController@success')->name('order.success');
Route::get('/thong-tin-tai-khoan', 'Front\UserController@me')->name('me');
Route::patch('/me/update', 'Front\UserController@update')->name('me.update');

Route::get('/admin', 'Admin\DashboardController@index');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
    Route::post('/filemanager/upload', '\Unisharp\Laravelfilemanager\Controllers\UploadController@upload');
});
Route::group(['middleware' => 'is.admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::get('categories/trash', 'Admin\CategoryController@listTrash')->name('categories.trash.list');
    Route::get('categories/rolback/{id}', 'Admin\CategoryController@rolback')->name('categories.rolback');
    Route::get('categories/trash/{id}', 'Admin\CategoryController@trash')->name('categories.trash.delete');
    Route::resource('categories', 'Admin\CategoryController');
    Route::get('articles/trash', 'Admin\ArticleController@listTrash')->name('articles.trash.list');
    Route::get('articles/rolback/{id}', 'Admin\ArticleController@rolback')->name('articles.rolback');
    Route::get('articles/trash/{id}', 'Admin\ArticleController@trash')->name('articles.trash.delete');
    Route::resource('articles', 'Admin\ArticleController');
    Route::get('users/trash', 'Admin\UserController@trash')->name('users.trash');
    Route::get('users/trash/{id}', 'Admin\UserController@trash_destroy')->name('users.trash.delete');
    Route::get('users/me', 'Admin\UserController@me')->name('users.me');
    Route::resource('users', 'Admin\UserController');
    Route::resource('menus', 'Admin\MenuController');
    Route::post('menus/order', 'Admin\MenuController@order')->name('menus.order');
    Route::post('menus/actions', 'Admin\MenuController@actions')->name('menus.actions');
    Route::get('orders/invoice/{order_id}', 'Admin\OrderController@invoice')->name('orders.invoice');
    Route::resource('orders', 'Admin\OrderController');
    Route::post('/ajax/upload', 'Admin\AjaxController@upload');
    Route::resource('settings', 'Admin\SettingController');
    Route::resource('contacts', 'Admin\ContactController');
    Route::get('pages/trash', 'Admin\PageController@listTrash')->name('pages.trash.list');
    Route::get('pages/rolback/{id}', 'Admin\PageController@rolback')->name('pages.rolback');
    Route::get('pages/trash/{id}', 'Admin\PageController@trash')->name('pages.trash.delete');
    Route::resource('pages', 'Admin\PageController');
    Route::get('affs/trash', 'Admin\AffController@listTrash')->name('affs.trash.list');
    Route::get('affs/rolback/{id}', 'Admin\AffController@rolback')->name('affs.rolback');
    Route::get('affs/trash/{id}', 'Admin\AffController@trash')->name('affs.trash.delete');
    Route::resource('affs', 'Admin\AffController');
    Route::resource('widgets', 'Admin\WidgetController');
    Route::post('widgets/actions', 'Admin\WidgetController@actions')->name('widgets.actions');
    Route::resource('makers', 'Admin\MakerController');
    Route::post('makers/actions', 'Admin\MakerController@actions')->name('makers.actions');
});
