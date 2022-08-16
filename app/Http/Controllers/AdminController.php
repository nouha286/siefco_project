<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Mail as FacadesMail;

class AdminController extends Controller
{
    public function index()
    {
        $Admin = Admin::all();
        $Admin_deleted = Admin::all();

        if (session()->has('role')) {
            return view('/Administrateur')->with(['Admin' => $Admin, 'Admin_deleted' => $Admin_deleted]);
        } else {
            return redirect('/Sign');
        }
    }
    public function addAdmin(Request $request)
    {


        $edit = request('Id');
        if (Admin::where('email', request('Email'))->exists()) {
            $id = Admin::where('email', request('Email'))->first(['id'])->id;
        } else {
            $id = '';
        }



        if ($edit) {
            $User = User::where('email', request('Email'))->first();
            if ($User && $id != $edit) {
                return redirect('/Administrateur')->with('error', 'هذا الحساب سبق استعماله');
            } elseif ($User && $id == $edit) {
                $Admin = Admin::where('id', $edit)->first();
                $Admin->First_Name = request('First_Name');
                $Admin->Last_Name = request('Last_Name');
                $Admin->Email = request('Email');
                $Admin->Number_phone = request('Phone');

                $User = User::where('id', $edit)->first();
                $User->First_Name = request('First_Name');
                $User->Last_Name = request('Last_Name');
                $User->email = request('Email');
                $User->Phone = request('Phone');

                $User->password = bcrypt(request('Password'));
                $User->save();
                $Admin->save();

                return redirect('/Administrateur')->with('success_delete', 'تم تعديل المسؤول بنجاح');
            } elseif (!$User && $id != $edit) {
                $Admin = Admin::where('id', $edit)->first();
                $Admin->First_Name = request('First_Name');
                $Admin->Last_Name = request('Last_Name');
                $Admin->Email = request('Email');
                $Admin->Number_phone = request('Phone');

                $User = User::where('id', $edit)->first();
                $User->First_Name = request('First_Name');
                $User->Last_Name = request('Last_Name');
                $User->email = request('Email');
                $User->Phone = request('Phone');

                $User->password = bcrypt(request('Password'));
                $User->save();
                $Admin->save();
                return redirect('/Administrateur')->with('success_delete', 'تم تعديل المسؤول بنجاح');
            }
        } else {

            $User = User::where('email', request('Email'))->first();
            if ($User) {
                return redirect('/Administrateur')->with('error', 'هذا الحساب سبق استعماله');
            } else {
                $Admin = new Admin();
                $Admin->First_Name = request('First_Name');
                $Admin->Last_Name = request('Last_Name');
                $Admin->Number_phone = request('Phone');
                $Admin->Email = request('Email');
                $Admin->Activation = 1;
                $User = new User();
                $User->First_Name = request('First_Name');
                $User->Last_Name = request('Last_Name');
                $User->email = request('Email');
                $User->Phone = request('Phone');
                $User->Role = 'Admin';
                $User->password = bcrypt(request('Password'));
                $User->Activation = 1;

                $User->save();
                $Admin->save();
                FacadesMail::to(request('Email'))->send(new EmailVerificationMail($User));

                return redirect('/Administrateur');
            }
        }
    }

    public function deleteAdmin($id)
    {
        $Admin = Admin::where('id', $id)->first();
        $email = Admin::where('id', $id)->first(['Email'])->Email;

        if ($Admin->Activation == 1) {
            $Admin->Activation = 0;
            $Admin->save();
        } elseif ($Admin->Activation == 0) {
            $Admin->Activation = 1;
            $Admin->save();
        }

        $User = User::where('email', $email)->first();
        if ($User) {
            if ($User->Activation == 1) {
                $User->Activation = 0;
                $User->Save();
                return redirect('/Administrateur')->with('success_restore', 'تم حذف المسؤول بنجاح');
                }
            if ($User->Activation == 0) {
                $User->Activation = 1;
                $User->Save();
                return redirect('/Administrateur')->with('success_delete', 'تم استعادة المسؤول بنجاح');

            }
        } else {
            return redirect('/Administrateur')->with('failed_delete', 'حدث خطا ما قد فشل الحذف ');
        }
    }
}
