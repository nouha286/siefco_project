<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\client;
use App\Models\User;
use App\Models\Comercial_Operation;

class Profile_ClientController extends Controller
{
    public function index()
    {
        $operation = Comercial_Operation::all();
        $Client = Client::where('id', session('id_Client'))->first();
        $comptOperation = Comercial_Operation::where('Client_id', session('id'))->get();
        $comptOperation = count($comptOperation);
        $User = User::where('id', session('id'))->first();


        if (session()->has('role_client')) {
            return view('/Profile_Client')->with(['operation' => $operation, 'Client' => $Client, 'comptOperation' => $comptOperation, 'User' => $User]);
        } else {
            return redirect('/Sign');
        }
    }

    public function editUser(Request $request, $Lang)
    {
       

        if (session('role_client') == 'Client') {
            $edit = request('Id');
            if (User::where('email', request('Email'))->exists()) {
                $id = User::where('email', request('Email'))->first(['id'])->id;
            } else {
                $id = '';
            }



            if ($edit) {


                $User = User::where('email', request('Email'))->first();

                if ($User && $id != $edit) {
                    return redirect($Lang.'/interface_client')->with('error', __('auth.existAccount'));
                } elseif ($User && $id == $edit) {


                    $Employee = User::where('id', $edit)->first();

                   
                    $Employee = User::where('id', $edit)->first();
                    if (request('First_Name')) {
                        $Employee->First_Name = request('First_Name');
                    }
                   
                    if (request('Last_Name')) {
                        $Employee->Last_Name = request('Last_Name');
                    }
                    if (request('Email')) {
                        $Employee->email = request('Email');
                    }
                    if (request('Phone')) {
                        $Employee->Phone = request('Phone');
                    }
                    if (request('password')) {
                        $request->validate([

                            'password' => 'required|min:6|max:255',
                            'old_password' => 'required|min:6|max:255',
                            'conf_password' => 'required|min:6|max:255|same:password',


                        ]);
                        $Employee->password = bcrypt(request('password'));
                        $Password = User::where('id', $edit)->first(['password'])->password;
                        if (!password_verify(request('old_password'), $Password)) {
                            return redirect($Lang.'/Profile')->with('error',  __('auth.wPassword'));
                        }
                    }
                    if (request('image')) {

                        $image_name = time() . '_' . request('image')->getClientOriginalName();
                        request('image')->move(public_path('assets/image'), $image_name);
                        $Employee->image = $image_name;
                    }

                    $email = User::where('id', $edit)->first(['Email'])->Email;

                    $User = Client::where('email', $email)->first();
                    if (request('First_Name')) {
                        $User->First_Name = request('First_Name');
                    }
                   
                    if (request('Last_Name')) {
                        $User->Last_Name = request('Last_Name');
                    }
                    if (request('Email')) {
                        $User->email = request('Email');
                    }
                    if (request('Phone')) {
                        $User->Number_phone = request('Phone');
                    }

                    $User->save();
                    $Employee->save();


                    return redirect($Lang.'/interface_client')->with('success_delete',  __('auth.editInfo'));
                } elseif (!$User && $id != $edit) {


                    $Employee = User::where('id', $edit)->first();

                   
                    $Employee = User::where('id', $edit)->first();
                    if (request('First_Name')) {
                        $Employee->First_Name = request('First_Name');
                    }
                   
                    if (request('Last_Name')) {
                        $Employee->Last_Name = request('Last_Name');
                    }
                    if (request('Email')) {
                        $Employee->email = request('Email');
                    }
                    if (request('Phone')) {
                        $Employee->Phone = request('Phone');
                    }
                      if (request('password')) {
                        $request->validate([

                            'password' => 'required|min:6|max:255',
                            'old_password' => 'required|min:6|max:255',
                            'conf_password' => 'required|min:6|max:255|same:password',


                        ]);
                        $Employee->password = bcrypt(request('password'));
                        $Password = User::where('id', $edit)->first(['password'])->password;
                        if (!password_verify(request('old_password'), $Password)) {
                            return redirect($Lang.'/Profile')->with('error',  __('auth.wPassword'));
                        }
                    }
                    if (request('image')) {

                        $image_name = time() . '_' . request('image')->getClientOriginalName();
                        request('image')->move(public_path('assets/image'), $image_name);
                        $Employee->image = $image_name;
                    }

                    $email = User::where('id', $edit)->first(['Email'])->Email;

                    $User = Client::where('email', $email)->first();

                    if (request('First_Name')) {
                        $User->First_Name = request('First_Name');
                    }
                   
                    if (request('Last_Name')) {
                        $User->Last_Name = request('Last_Name');
                    }
                    if (request('Email')) {
                        $User->email = request('Email');
                    }
                    if (request('Phone')) {
                        $User->Number_phone = request('Phone');
                    }

                    $User->save();
                    $Employee->save();


                    return redirect($Lang.'/interface_client')->with('success_delete',  __('auth.editInfo'));
                }
            }
        }
    }
}
