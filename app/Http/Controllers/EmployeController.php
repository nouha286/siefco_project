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
    public function index(){
    $Employee = Employees::all();

        if (session()->has('role')) {
            return view('/Employees')->with(['Employee' => $Employee]);
        } else {
            return redirect('/Sign');
        }
    }
    public function addEmploye(Request $request)
    {
        

        $User=User::where('email',request('Email'))->first();
       if ($User) {
        return redirect('/Employees')->with('error','هذا الحساب سبق استعماله');
       }else{
        $Employee = new Employees();
        $Employee->First_Name = request('First_Name');
        $Employee->Last_Name = request('Last_Name');
        $Employee->Number_phone = request('Phone');
        $Employee->Email = request('Email');
        $User=new User();
        $User->First_Name=request('First_Name');
            $User->Last_Name=request('Last_Name');
            $User->email=request('Email');
            $User->Phone=request('Phone');
            $User->Role='employe';
            $User->password=bcrypt(request('Password'));
            $User->Activation=1;

            $User->save();
        $Employee->save();
        FacadesMail::to(request('Email'))->send(new EmailVerificationMail($User));
        
        return redirect('/Employees');
       }
        
    }

    public function deleteEmploye($id)
    {
        $Employee = Employees::where('id', $id)->first();
        $email=Employees::where('id', $id)->first(['Email'])->Email;
        
        
        $User=User::where('email',$email)->first();
        if ($User) {
            $User->Activation=0;
        $User->Save();
        $Employee->delete();
        return redirect('/Employees')->with('success_delete','تم حذف المسؤول بنجاح');
        }else {
            return redirect('/Employees')->with('failed_delete','حدث خطا ما قد فشل الحذف   ');
        }
       
     ;
    }
}
