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
    if (session()->has('role')) {
        return redirect('Dashboard');
    }else
    {
        return redirect('home');
    }
});

Route::get('/Administrateur','AdminController@index');
Route::post('/Administrateur','AdminController@addAdmin')->name('add.Admin');
Route::delete('/Administrateur/{id}','AdminController@deleteAdmin')->name('delete.Admin');

Route::get('/client', function () {
    if (session()->has('role')) {
        return view('/client');
    }else
    {
        return redirect('/Sign');
    }
});
Route::get('/Dashboard', function () {
    
    if (session()->has('role')) {
        return view('Dashboard');
    }else
    {
        return redirect('Sign');
    }
});
Route::get('/devise', 'DeviseController@index');

Route::post('/devise','DeviseController@addDevise')->name('add.devise');
Route::delete('devise/{id}','DeviseController@deleteDevise')->name('delete.devise');
Route::put('devise','DeviseController@editDevise')->name('edit.devise');

Route::get('/Employees', 'EmployeController@index');
Route::post('/Employees','EmployeController@addEmploye')->name('add.Employe');
Route::delete('Employees/{id}','EmployeController@deleteEmploye')->name('delete.Employe');

Route::get('/home', function () {
    if (session()->has('role')) {
        return redirect('Dashboard');
    }else
    {
        return view('/home');
    }
});

Route::get('/interface_client', function () {
    if (session()->has('role_client')) {
        return view('/interface_client');
    }else
    {
        return redirect('/Sign');
    }
});

Route::get('/operation_commercial', function () {
    if (session()->has('role')) {
        return view('/operation_commercial');
    }else
    {
        return redirect('/Sign');
    }
});

Route::get('/Sign', function () {
    if (session()->has('role')) {
        return redirect('Dashboard');
    }elseif (session()->has('role_client')) 
    {
        return redirect('interface_client');
    }else{
        return view('/Sign');
    }
});
Route::post('/Sign','UserController@connexion' )->name('connexion.auth');

Route::get('/Sign_Up', function () {
    if (session()->has('role')) {
        return redirect('Dashboard');
    }elseif (session()->has('role_client')) 
    {
        return redirect('interface_client');
    }else{
        return view('/Sign_Up');
    }
});
Route::post('/Sign_Up','UserController@inscription' )->name('inscription.auth');

Route::get('/verify-email/{id}','UserController@verify_email' )->name('verify_email');

Route::get('/logout','UserController@logout');



