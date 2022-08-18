<?php

namespace App\Http\Controllers;

use App\Models\Identificateur;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use App\Models\User;

use App\Models\client;
use Illuminate\Validation\Validator;
use phpDocumentor\Reflection\Types\Null_;
use Mail;
use App\Mail\EmailVerificationMail;
use App\Models\Employees;
use Illuminate\Support\Facades\Mail as FacadesMail;

class UserController extends Controller
{
    public function inscription(Request $request)
    {
        
       $User=User::where('email',request('email'))->first();
       if ($User) {
        return redirect('/Sign_Up')->with('error','هذا الحساب سبق استعماله');
       }else{

        $request->validate([
            'email' => 'required|max:255|email',
            'Last_Name' => 'required',
            'First_Name' => 'required',
          'password'=>'required|min:6',
          'conf_password'=>'required|min:6|same:password',
            'phone' => 'required|numeric',
            
        ]);
        $User=new User();
            $User->First_Name=request('First_Name');
            $User->Last_Name=request('Last_Name');
            $User->email=request('email');
            $User->Phone=request('phone');
            $User->Role=request('role');
            $User->password=bcrypt(request('password'));
            $User->Activation=2;
            $User->image = 'avatar.png';
            $identificateur=Identificateur::where('id',1)->first();
            if (request('role')=='Employe') 
            {
                $request->validate([
                    'email' => 'required|max:255|email',
                    'Last_Name' => 'required',
                    'First_Name' => 'required',
                  'password'=>'required|min:6',
                  'conf_password'=>'required|min:6|same:password',
                    'phone' => 'required|numeric',
                    'n_identif'=>'required|numeric'
                    
                ]);
                $N=Identificateur::where('id', 1 )->first(['Numéro'])->Numéro;
                if ($N==request('n_identif')) {
                     $identificateur->Numéro=$N+5;
                     $identificateur->save();
                     $User->save();
                     FacadesMail::to(request('email'))->send(new EmailVerificationMail($User));
                    return redirect('/Sign')->with('success','   تم اظافة الحساب بنجاح المرجو التحقق من علبة الرسائل لتلقي بريد التفعيل ');
                }else {
                    return redirect('/Sign_Up')->with('failed','المستخدمون فقط من يستطيعون انشاء حساب المرجو ادخال رقم تسجيل صالح');
                }
            }
            if (request('role')=='Client') {
                $User->save();
                FacadesMail::to(request('email'))->send(new EmailVerificationMail($User));

                return redirect('/Sign')->with('success',' تم اظافة الحساب بنجاح المرجو التحقق من علبة الرسائل لتلقي بريد التفعيل');
            }
       }
    }
// for connexion
    public function connexion(Request $request)
    {
        //validation backend
        $request->validate([
            'email' => 'required|max:255|email',
         
          'password'=>'required|min:6',
       
       
            
        ]);
       $resultat=auth()->attempt([
        'email'=>request('email'),
        'password'=>request('password'),
        'Activation'=> 1
       ]);
       $email=request('email');
       if ($Role = User::where('email', $email )->exists()) {
        $Role = User::where('email', $email )->first(['Role'])->Role;
       }else $Role='';

       
    if ($resultat && $Role=='Client' )
    {
        $Last_Name=User::where('email',$email)->first('Last_Name')->Last_Name;
        $First_Name=User::where('email',$email)->first('First_Name')->First_Name;
        $request->session()->put('role_client', $Role);
        $request->session()->put('First_Name',$First_Name);
        $request->session()->put('Last_Name',$Last_Name);
        $User=User::where('email',$email)->first('id')->id;
        $Client=Client::where('email',$email)->first('id')->id;
        $request->session()->put('id',$User);
        $request->session()->put('id_Client',$Client);
        return redirect('/interface_client');
    }

    if ($resultat && ($Role=='Employe'|| $Role=='Admin') )
    {
        $Last_Name=User::where('email',$email)->first('Last_Name')->Last_Name;
        $First_Name=User::where('email',$email)->first('First_Name')->First_Name;
    
        $request->session()->put('role', $Role);
        $request->session()->put('First_Name',$First_Name);
        $request->session()->put('Last_Name',$Last_Name); 
        if($Role=='Admin'){
            $id = User::where('email', $email )->first(['id'])->id;
            $request->session()->put('id',$id);
        }
        if($Role=='Employe'){
            $id = User::where('email', $email )->first(['id'])->id;
            $request->session()->put('id',$id);
        }
      
       
        return redirect('/Dashboard');
    }
    if (!$resultat ) {
        return redirect('/Sign')->with('error','البريد الالكتروني او القن السري خاطئ');
    }
    }


    public function verify_email($id)
    {

       $User=User::where('id', $id)->first();

       if (!$User)
       {
        return redirect('/Sign_Up')->with('error','Invalid URL');
       }else
       {
        if ($User->email_verified_at) {
            return Redirect('/Sign_Up')->with('warning','Email already verified');

        }else{
            $User->email_verified_at=\Carbon\Carbon::now();
            $User->save();



            return redirect('/Sign_Up')->with('success','Email successfully verified');

        }

       }
    }

//for logout
    public function logout(Request $request)
    {
        $request->session()->forget('role');
        $request->session()->forget('vérification');
        $request->session()->forget('non_vérification');
        $request->session()->forget('role_client');
        $request->session()->forget('First_Name');
        $request->session()->forget('Last_Name');
        $request->session()->forget('id');
        $request->session()->forget('id_Client');
        return Redirect('/Sign');
    }


}
