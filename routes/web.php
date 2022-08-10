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

Route::get('/', function () {
    return view('home');
});

Route::get('/Administrateur', function () {
    return view('Administrateur');
});
Route::get('/client', function () {
    return view('client');
});
Route::get('/Dashboard', function () {
    return view('Dashboard');
});
Route::get('/devise', function () {
    return view('devise');
});

Route::get('/Employees', function () {
    return view('Employees');
});

Route::get('/home', 'HomeController@index');

Route::get('/interface_client', function () {
    return view('interface_client');
});

Route::get('/operation_commercial', function () {
    return view('operation_commercial');
});

Route::get('/Sign', function () {
    return view('Sign');
});

Route::post('/Sign','UserController@inscription' )->name('inscription.auth');



