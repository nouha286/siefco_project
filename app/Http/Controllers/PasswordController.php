<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\EmailResetPassword;

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

   public function issetEmail(Request $request, $Lang)
   {
    $request->validate([
        'email' => 'required|max:255|email',
     
    ]);
    $email=request('email');
    if(User::where('email', $email )->exists())
    {$User=User::where('email',$email)->first();
     
      
       if (FacadesMail::to(request('email'))->send(new EmailResetPassword($User))) {
       
        return redirect($Lang.'/Forget_password')->with('success',__('auth.forgetPassword'));
        
       } else
       {
        return redirect($Lang.'/Forget_password')->with('error',__('auth.errorPassword'));
        
       }
       
    }
    else
    {
        return redirect($Lang.'/Forget_password')-> with('error',__('auth.notExist'));
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
  
    else{
        return view('/Reset_password')->with('id',$id);

    }
   }

   public function Reset_password( $id, Request $request, $Lang)
   {
    $request->validate([
      'conf_password'=>'required|min:6',
     
      'password'=>'required|min:6',
   
   
        
    ]);
    $User=User::where('id', $id )->first();
    $User->password=bcrypt(request('password'));
    $User->save();
  
    return redirect($Lang.'/Sign')-> with('success',__('auth.resetPassword'));
   }
}
