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

        if (session()->has('role')) {
            return view('/Administrateur')->with(['Admin' => $Admin]);
        } else {
            return redirect('/Sign');
        }
    }
    public function addAdmin(Request $request)
    {


        $User=User::where('email',request('Email'))->first();
       if ($User) {
        return redirect('/Administrateur')->with('error','هذا الحساب سبق استعماله');
       }else{
        $Admin = new Admin();
        $Admin->First_Name = request('First_Name');
        $Admin->Last_Name = request('Last_Name');
        $Admin->Number_phone = request('Phone');
        $Admin->Email = request('Email');
        $User=new User();
        $User->First_Name=request('First_Name');
            $User->Last_Name=request('Last_Name');
            $User->email=request('Email');
            $User->Phone=request('Phone');
            $User->Role='Admin';
            $User->password=bcrypt(request('Password'));
            $User->Activation=1;

            $User->save();
        $Admin->save();
        FacadesMail::to(request('Email'))->send(new EmailVerificationMail($User));

        return redirect('/Administrateur');
       }

    }

    public function deleteAdmin($id)
    {
        $Admin = Admin::where('id', $id)->first();
        $email=Admin::where('id', $id)->first(['Email'])->Email;


        $User=User::where('email',$email)->first();
        if ($User) {
            $User->Activation=0;
        $User->Save();
        $Admin->delete();
        return redirect('/Administrateur')->with('success_delete','تم حذف المسؤول بنجاح');
        }else {
            return redirect('/Administrateur')->with('failed_delete','حدث خطا ما قد فشل الحذف ');
        }
    }
}
