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

// Route::get('/Administrateur','AdminController@index');
// Route::post('/Administrateur','AdminController@addAdmin')->name('add.Admin');
// Route::delete('/Administrateur/{id}','AdminController@deleteAdmin')->name('delete.Admin');


//routes for client
Route::get('/client', 'ClientController@index');
Route::post('/client','ClientController@addClient')->name('add.Client');
Route::delete('/client/{id}','ClientController@deleteClient')->name('delete.Client');


//for dashboard

Route::get('/Dashboard','DashboardController@index');
Route::post('/Dashboard/{id}','DashboardController@Activer')->name('Activer');
Route::delete('Dashboard/{id}','DashboardController@Supprimer')->name('Supprimer');

//for devise
Route::get('/devise', 'DeviseController@index');
Route::post('/devise','DeviseController@addDevise')->name('add.devise');
Route::delete('devise/{id}','DeviseController@deleteDevise')->name('delete.devise');
//
//
//for Employee
Route::get('/Employees', 'EmployeController@index');
Route::post('/Employees','EmployeController@addEmploye')->name('add.Employe');
Route::delete('Employees/{id}','EmployeController@deleteEmploye')->name('delete.Employe');

//for home
Route::get('/home', function () {
    if (session()->has('role')) {
        return redirect('Dashboard');
    }
    else{
        return view('/home');
    }
});


//for interface
Route::get('/interface_client', 'interface_clientController@index');

//for  operation
Route::get('/operation_commercial', 'OperationCommercialController@index');
Route::post('/operation_commercial','OperationCommercialController@addOperation')->name('add.Operation');
Route::delete('operation_commercial/{id}','OperationCommercialController@deleteOperation')->name('delete.Operation');


// Generate Pdf
// Route::get('/SIEFCO', 'PDFController@index');
Route::get('generatePDF', 'PDFController@generatePDF');



//for sign
Route::get('/Sign', function () {
    if (session()->has('role')) {
        return redirect('Dashboard');
    }
    elseif (session()->has('role_client')){
        return redirect('interface_client');
    }
    else{
        return view('/Sign');
    }
});
Route::post('/Sign','UserController@connexion' )->name('connexion.auth');


//for sign up

Route::get('/Sign_Up', function () {
    if (session()->has('role')) {
        return redirect('Dashboard');
    }
    elseif (session()->has('role_client')){
        return redirect('interface_client');
    }
    else{
        return view('/Sign_Up');
    }
});
Route::post('/Sign_Up','UserController@inscription' )->name('inscription.auth');

Route::get('/verify-email/{id}','UserController@verify_email' )->name('verify_email');

Route::get('/logout','UserController@logout');

//for profile

Route::get('/Profile','ProfileController@index');
Route::post('/Profile','ProfileController@editUser' )->name('edit');

//for profile client
Route::get('/Profile_Client','Profile_ClientController@index');
Route::post('/Profile_Client','Profile_ClientController@editUser' )->name('editClient');


// for forget password
Route::get('/Forget_password','PasswordController@index');
Route::post('/Forget_password','PasswordController@issetemail')->name('ifissetemail');
//for reset password
Route::get('/Reset_password/{id}','PasswordController@indexReset_password')->name('resetPassword');
Route::post('/Reset_password/{id}','PasswordController@Reset_password')->name('reset.password');
