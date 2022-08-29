<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {

        $User = User::where('id', session('id'))->first();
        $Password = User::where('id', session('id'))->first(['password'])->password;



        if (session()->has('role')) {
            return view('/Profile')->with(['User' => $User]);
        } else {
            return redirect('/Sign');
        }
    }

    public function editUser(Request $request)
    {
        $request->validate([
            'Email' => 'required|max:255|email',
            'Last_Name' => 'required',
            'First_Name' => 'required',

            'Phone' => 'required',

        ]);

        if (session('role') == 'Employe') {
            $edit = request('Id');
            if (User::where('email', request('Email'))->exists()) {
                $id = User::where('email', request('Email'))->first(['id'])->id;
            } else {
                $id = '';
            }



            if ($edit) {


                $User = User::where('email', request('Email'))->first();

                if ($User && $id != $edit) {
                    return redirect('/Dashboard')->with('error', __('auth.existAccount'));
                } elseif ($User && $id == $edit) {


                    $Employee = User::where('id', $edit)->first();

                    $Employee->Last_Name = request('Last_Name');
                    $Employee->email = request('Email');
                    $Employee->First_Name = request('First_Name');
                    $Employee->Phone = request('Phone');
                    if (request('password')) {
                        $request->validate([

                            'password' => 'required|min:6|max:255',
                            'old_password' => 'required|min:6|max:255',
                            'conf_password' => 'required|min:6|max:255|same:password',


                        ]);
                        $Employee->password = bcrypt(request('password'));
                        $Password = User::where('id', $edit)->first(['password'])->password;
                        if (!password_verify(request('old_password'), $Password)) {
                            return redirect('/Profile')->with('error',  __('auth.wrongPassword'));
                        }
                    }
                    if (request('image')) {
                        $image_name = time() . '_' . request('image')->getClientOriginalName();
                        request('image')->move(public_path('assets/image'), $image_name);
                        $Employee->image = $image_name;
                    }
                    $email = User::where('id', $edit)->first(['Email'])->Email;

                    $User = Employees::where('email', $email)->first();
                    $User->First_Name = request('First_Name');
                    $User->Last_Name = request('Last_Name');
                    $User->email = request('Email');
                    $User->Number_phone = request('Phone');


                    $User->save();
                    $Employee->save();


                    return redirect('/Dashboard')->with('success_delete',  __('auth.editInfo'));
                } elseif (!$User && $id != $edit) {


                    $Employee = User::where('id', $edit)->first();

                    $Employee->Last_Name = request('Last_Name');
                    $Employee->email = request('Email');
                    $Employee->First_Name = request('First_Name');
                    $Employee->Phone = request('Phone');
                    if (request('password')) {
                        $request->validate([

                            'password' => 'required|min:6|max:255',
                            'old_password' => 'required|min:6|max:255',
                            'conf_password' => 'required|min:6|max:255|same:password',


                        ]);
                        $Employee->password = bcrypt(request('password'));
                        $Password = User::where('id', $edit)->first(['password'])->password;
                        if (!password_verify(request('old_password'), $Password)) {
                            return redirect('/Profile')->with('error',  __('auth.wrongPassword'));
                        }
                    }

                    if (request('image')) {
                        $image_name = time() . '_' . request('image')->getClientOriginalName();
                        request('image')->move(public_path('assets/image'), $image_name);
                        $Employee->image = $image_name;
                    }
                    $email = User::where('id', $edit)->first(['Email'])->Email;

                    $User = Employees::where('email', $email)->first();
                    $User->First_Name = request('First_Name');
                    $User->Last_Name = request('Last_Name');
                    $User->email = request('Email');
                    $User->Number_phone = request('Phone');

                    $User->save();
                    $Employee->save();


                    return redirect('/Dashboard')->with('success_delete',  __('auth.editInfo'));
                }
            }
        }
        if (session('role') == 'Admin') {
            $edit = request('Id');
            if (User::where('email', request('Email'))->exists()) {
                $id = User::where('email', request('Email'))->first(['id'])->id;
            } else {
                $id = '';
            }



            if ($edit) {


                $User = User::where('email', request('Email'))->first();

                if ($User && $id != $edit) {
                    return redirect('/Dashboard')->with('error', __('auth.existAccount'));
                } elseif ($User && $id == $edit) {


                    $Employee = User::where('id', $edit)->first();

                    $Employee->Last_Name = request('Last_Name');
                    $Employee->email = request('Email');
                    $Employee->First_Name = request('First_Name');
                    $Employee->Phone = request('Phone');
                    if (request('password')) {
                        $request->validate([

                            'password' => 'required|min:6|max:255',
                            'old_password' => 'required|min:6|max:255',
                            'conf_password' => 'required|min:6|max:255|same:password',


                        ]);
                        $Employee->password = bcrypt(request('password'));
                        $Password = User::where('id', $edit)->first(['password'])->password;
                        if (!password_verify(request('old_password'), $Password)) {
                            return redirect('/Profile')->with('error',  __('auth.wrongPassword'));
                        }
                    }
                    if (request('image')) {
                        $image_name = time() . '_' . request('image')->getClientOriginalName();
                        request('image')->move(public_path('assets/image'), $image_name);
                        $Employee->image = $image_name;
                    }





                    $Employee->save();


                    return redirect('/Dashboard')->with('success_delete',  __('auth.editInfo'));
                } elseif (!$User && $id != $edit) {


                    $Employee = User::where('id', $edit)->first();

                    $Employee->Last_Name = request('Last_Name');
                    $Employee->email = request('Email');
                    $Employee->First_Name = request('First_Name');
                    $Employee->Phone = request('Phone');
                    if (request('password')) {
                        $request->validate([

                            'password' => 'required|min:6|max:255',
                            'old_password' => 'required|min:6|max:255',
                            'conf_password' => 'required|min:6|max:255|same:password',


                        ]);
                        $Employee->password = bcrypt(request('password'));
                        $Password = User::where('id', $edit)->first(['password'])->password;
                        if (!password_verify(request('old_password'), $Password)) {
                            return redirect('/Profile')->with('error',  __('auth.wrongPassword'));
                        }
                    }
                    if (request('image')) {
                        $image_name = time() . '_' . request('image')->getClientOriginalName();
                        request('image')->move(public_path('assets/image'), $image_name);
                        $Employee->image = $image_name;
                    }


                    $Employee->save();


                    return redirect('/Dashboard')->with('success_delete',  __('auth.editInfo'));
                }
            }
        }
    }
}
