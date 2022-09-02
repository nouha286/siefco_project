<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employees;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Mail as FacadesMail;

class EmployeController extends Controller
{
    public function index()
    {
        $Employee = Employees::all();
        $Employee_deleted = Employees::all();
        $User = User::where('id', session('id'))->first();

        if (session()->has('role')) {
            return view('/Employees')->with(['Employee' => $Employee, 'Employee_deleted' => $Employee_deleted, 'User' => $User]);
        } else {
            return redirect('/Sign');
        }
    }



    public function addEmploye(Request $request, $Lang)
    {

        $edit = request('Id');
        if (Employees::where('email', request('Email'))->exists()) {
            $id = Employees::where('email', request('Email'))->first(['id'])->id;
        } else {
            $id = '';
        }



        if ($edit) {


            $User = User::where('email', request('Email'))->first();

            if ($User && $id != $edit) {
                $request->validate([
                    'Email' => 'required|max:255|email',
                    'Last_Name' => 'required',
                    'First_Name' => 'required',


                    'Phone' => 'required',

                ]);
                return redirect($Lang.'/Employees')->with('error', __('auth.existAccount'));
            } elseif ($User && $id == $edit) {

                $request->validate([
                    'Email' => 'required|max:255|email',
                    'Last_Name' => 'required',
                    'First_Name' => 'required',


                    'Phone' => 'required',

                ]);
                $Employee = Employees::where('id', $edit)->first();

                $Employee->Last_Name = request('Last_Name');
                $Employee->Email = request('Email');
                $Employee->First_Name = request('First_Name');
                $Employee->Number_phone = request('Phone');

                $email = Employees::where('id', $edit)->first(['Email'])->Email;

                $User = User::where('email', $email)->first();
                $User->First_Name = request('First_Name');
                $User->Last_Name = request('Last_Name');
                $User->email = request('Email');
                $User->Phone = request('Phone');



                $User->save();
                $Employee->save();


                return redirect($Lang.'/Employees')->with('success_delete',  __('auth.editEmploye'));
            } elseif (!$User && $id != $edit) {

                $request->validate([
                    'Email' => 'required|max:255|email',
                    'Last_Name' => 'required',
                    'First_Name' => 'required',


                    'Phone' => 'required',

                ]);

                $Employee = Employees::where('id', $edit)->first();

                $Employee->Last_Name = request('Last_Name');
                $Employee->Email = request('Email');
                $Employee->First_Name = request('First_Name');
                $Employee->Number_phone = request('Phone');

                $email = Employees::where('id', $edit)->first(['Email'])->Email;

                $User = User::where('email', $email)->first();
                $User->First_Name = request('First_Name');
                $User->Last_Name = request('Last_Name');
                $User->email = request('Email');
                $User->Phone = request('Phone');


                $User->save();
                $Employee->save();


                return redirect($Lang.'/Employees')->with('success_delete',  __('auth.editEmploye'));
            }
        } else {
            $request->validate([
                'Email' => 'required|max:255|email',
                'Last_Name' => 'required',
                'First_Name' => 'required',
                'Password' => 'required|min:6|max:255',
                'conf_password' => 'required|min:6|max:255|same:Password',
                'Phone' => 'required',

            ]);

            $User = User::where('email', request('Email'))->first();
            if ($User) {
                return redirect($Lang.'/Employees')->with('error',  __('auth.existAccount'));
            } else {


                $Employee = new Employees();
                $Employee->First_Name = request('First_Name');
                $Employee->Last_Name = request('Last_Name');
                $Employee->Number_phone = request('Phone');
                $Employee->Email = request('Email');
                $Employee->Activation = 1;

                $User = new User();
                $User->First_Name = request('First_Name');
                $User->Last_Name = request('Last_Name');
                $User->email = request('Email');
                $User->Phone = request('Phone');
                $User->Role = 'Employe';
                $User->password = bcrypt(request('Password'));
                $User->Activation = 1;
                $User->image = 'avatar.png';
                $User->save();
                $Employee->save();
                FacadesMail::to(request('Email'))->send(new EmailVerificationMail($User));

                return redirect($Lang.'/Employees')->with('success_delete',__('auth.addEmploye'));
            }
        }
    }

    public function deleteEmploye($id, $Lang)
    {
        $Employee = Employees::where('id', $id)->first();
        $email = Employees::where('id', $id)->first(['Email'])->Email;

        if ($Employee->Activation == 1) {
            $Employee->Activation = 0;
            $Employee->save();
        } elseif ($Employee->Activation == 0) {
            $Employee->Activation = 1;
            $Employee->save();
        }
        $User = User::where('email', $email)->first();
        if ($User) {
            if ($User->Activation == 1) {
                $User->Activation = 0;
                $User->Save();
                return redirect($Lang.'/Employees')->with('success_delete',  __('auth.deleteEmploye'));
            }
            if ($User->Activation == 0) {
                $User->Activation = 1;
                $User->Save();
                return redirect($Lang.'/Employees')->with('success_restore',  __('auth.restoreEmploye'));
            }
        } else {
            return redirect($Lang.'/Employees')->with('failed_delete', __('auth.failed_delete'));
        }
    }
}
