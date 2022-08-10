<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use App\Models\User;
use Illuminate\Validation\Validator;


class UserController extends Controller
{
    public function inscription(Request $request)
    {
       
           
           
            $User=new User();
            $User->First_Name=request('First_Name');
            $User->Last_Name=request('Last_Name');
            $User->email=request('email');
            $User->Phone=request('phone');
            $User->Role=request('role');
            $User->password=bcrypt(request('password'));
            $User->Activation=0;
            $User->save();
            
            return redirect('/Sign');
            
    }

    public function connexion()
    {
       $resultat=auth()->attempt([
        'email'=>request('email'),
        'password'=>request('password'),
        'Activation'=> 1

       ]);

       var_dump($resultat); 
       var_dump(request('email'));
       var_dump(request('password'));
    }

    
}
