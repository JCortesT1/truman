<?php

use App\Cellar;
use App\Product;
use Illuminate\Support\Facades\Auth;
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

Route::get('inventario', function () {
    return Cellar::find(1)->products;
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('cellars', 'CellarController');

Route::resource('percents', 'PercentController');
Route::get('getPercents', 'PercentController@getPercents');

Route::resource('orden_ventas', 'OrdenVentaController');
Route::get('close', 'OrdenVentaController@close')->name('orden_ventas.close');
Route::get('documentos', 'OrdenVentaController@documentos');
Route::get('formasPago', 'OrdenVentaController@formasPago');
Route::get('getSales/{fecha}', 'OrdenVentaController@getSales');
Route::get('getDocumentsResume/{fecha}', 'OrdenVentaController@getDocumentsResume');

Route::resource('products', 'ProductController');
Route::get('autores', 'ProductController@autores');
Route::get('editoriales', 'ProductController@editoriales');
Route::get('temas', 'ProductController@temas');

Route::get('getDocuments', 'DocumentController@getDocuments');
Route::get('getPayMethods', 'DocumentController@getPayMethods');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
