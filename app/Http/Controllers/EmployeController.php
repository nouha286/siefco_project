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

        if (session()->has('role')) {
            return view('/Employees')->with(['Employee' => $Employee, 'Employee_deleted'=> $Employee_deleted]);
        } else {
            return redirect('/Sign');
        }
    }



    public function addEmploye(Request $request)
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
                return redirect('/Employees')->with('error', 'هذا الحساب سبق استعماله');
            } elseif ($User && $id == $edit) {


                $Employee = Employees::where('id', $edit)->first();

                $Employee->Last_Name = request('Last_Name');
                $Employee->Email = request('Email');
                $Employee->First_Name = request('First_Name');
                $Employee->Number_phone = request('Phone');

                $email = Employees::where('id', $edit)->first(['Email'])->Email;
               
                $User=User::where('email',$email)->first();
                $User->First_Name = request('First_Name');
                $User->Last_Name = request('Last_Name');
                $User->email = request('Email');
                $User->Phone = request('Phone');
            
                $User->password = bcrypt(request('Password'));
                $User->save();
                $Employee->save();


                return redirect('/Employees')->with('success_delete', 'تم تعديل المستخدم بنجاح');
            } elseif (!$User && $id != $edit) {


                $Employee = Employees::where('id', $edit)->first();

                $Employee->Last_Name = request('Last_Name');
                $Employee->Email = request('Email');
                $Employee->First_Name = request('First_Name');
                $Employee->Number_phone = request('Phone');

                $email = Employees::where('id', $edit)->first(['Email'])->Email;
              
                $User=User::where('email',$email)->first();
                $User->First_Name = request('First_Name');
                $User->Last_Name = request('Last_Name');
                $User->email = request('Email');
                $User->Phone = request('Phone');
               
                $User->password = bcrypt(request('Password'));
                $User->save();
                $Employee->save();


                return redirect('/Employees')->with('success_delete', 'تم تعديل المستخدم بنجاح');
            }
        } else {

            $User = User::where('email', request('Email'))->first();
            if ($User) {
                return redirect('/Employees')->with('error', 'هذا الحساب سبق استعماله');
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

                $User->save();
                $Employee->save();
                FacadesMail::to(request('Email'))->send(new EmailVerificationMail($User));

                return redirect('/Employees');
            }
        }
    }

    public function deleteEmploye($id)
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
                return redirect('/Employees')->with('success_delete', 'تم حذف المستخدم بنجاح');
           
                }
            if ($User->Activation == 0) {
                $User->Activation = 1;
                $User->Save();
                return redirect('/Employees')->with('success_restore', 'تم استعادة المستخدم بنجاح');
               
            }
        } else {
            return redirect('/Employees')->with('failed_delete', 'حدث خطا ما قد فشل الحذف ');
        }
    }
}
