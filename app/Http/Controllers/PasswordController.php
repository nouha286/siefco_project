<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\EmailVerificationMail;

use Illuminate\Support\Facades\Mail as FacadesMail;
class PasswordController extends Controller
{
   public function index()
   {
    if (session()->has('role')) {
        return redirect('Dashboard');
    }
    elseif (session()->has('role_client')){
        return redirect('interface_client');
    }
    else{
        return view('/Forget_password');
    }
   }

   public function issetEmail(Request $request)
   {
    $email=request('email');
    if(User::where('email', $email )->exists())
    {$User=User::where('email',$email)->first();
     
      
       if (FacadesMail::to(request('email'))->send(new EmailVerificationMail($User))) {
        $request->session()->put('email',$email);
        return redirect('/Forget_password')->with('success','     المرجو التاكد من بريدكم الاكتروني ستتوصلون برابط تجديد القن السري');
        
       } else
       {
        return redirect('/Forget_password')->with('error','حذث خطا ما اثناء الارسال');
        
       }
       
    }
    else
    {
        return redirect('/Forget_password')-> with('error','لا يوجد اي حساب يتطابق مع هذا البريد الالكتروني');
    }
   }



   public function indexReset_password($id)
   {
    if (session()->has('role')) {
        return redirect('Dashboard');
    }
    elseif (session()->has('role_client')){
        return redirect('interface_client');
    }
   elseif(session()->has('email')){
    return view('/Reset_password')->with('id',$id);
    }
    else{
        return redirect('Sign');
    }
   }

   public function Reset_password( $id, Request $request)
   {
    $User=User::where('id', $id )->first();
    $User->password=bcrypt(request('password'));
    $User->save();
    $request->session()->forget('email');
    return redirect('/Sign')-> with('success','تم تعديل القن السري بنجاح');
   }
}
