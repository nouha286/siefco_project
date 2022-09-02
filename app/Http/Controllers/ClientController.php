<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use App\Models\devise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as FacadesMail;
use App\Mail\EmailVerificationMail;
class ClientController extends Controller
{
    public function index()
    {
        $client = client::all();
       
        $client_delete = client::all();
        $devise = devise::where('Activation' , 1)->get();
        $User=User::where('id',session('id'))->first();
       
        $devise_edit = devise::where('Activation' , 1)->get();
        if(session()->has('role')) {
            return view('/client')->with(['client' => $client , 'devise' => $devise,'devise_edit' => $devise_edit,'client_delete'=>$client_delete, 'User'=>$User ]);
        }
        else{
            return redirect('/Sign');
        }
    }

    public function addClient(Request $request, $Lang)
    {
        $edit = request('Id');
        if (client::where('email', request('Email'))->exists()) {
            $id = client::where('email', request('Email'))->first(['id'])->id;
        } else {
            $id = '';
        }



        if ($edit) {


            $User = User::where('email', request('Email'))->first();
            if ($User && $id != $edit) {
                return redirect($Lang.'/client')->with('error', __('auth.existAccount'));
            } elseif ($User && $id == $edit) {

                $request->validate([
                    'Email' => 'required|max:255|email',
                    'Last_Name' => 'required',
                    'First_Name' => 'required',
                    'Phone' => 'required|numeric',
                    'Balance' => 'required|numeric',
                    'devise' => 'required',
                ]);
                $Client = client::where('id', $edit)->first();

                $Client->Last_Name = request('Last_Name');
                $Client->Email = request('Email');
                $Client->First_Name = request('First_Name');
                $Client->Number_phone = request('Phone');
                $Client->Balance = request('Balance');
                $id_devise=request('devise'); 
                $devise = devise::where('id' , $id_devise)->first(['Name'])->Name;
                $Client->Currency = $devise;
                
                $Client->Debtor=0;
                $Client->Creditor=0;
                $User = User::where('id', session('id'))->first();
                
                $Client->Statement='انشئ من طرف - Created by '.$User->First_Name . ' ' . $User->Last_Name;
                $email = client::where('id', $edit)->first(['Email'])->Email;
             
                $User=User::where('email',$email)->first();

              
                $User->First_Name = request('First_Name');
                $User->Last_Name = request('Last_Name');
                $User->email = request('Email');
                $User->Phone = request('Phone');
            
             
                $User->save();
                $Client->save();


                return redirect($Lang.'/client')->with('success_delete', __('auth.editClient'));
            } elseif (!$User && $id != $edit) {
                $request->validate([
                    'Email' => 'required|max:255|email',
                    'Last_Name' => 'required',
                    'First_Name' => 'required',
                    'Phone' => 'required',
                    'Balance' => 'required|numeric',
                    'devise' => 'required',
                    
                ]);

                $Client = client::where('id', $edit)->first();

                $Client->Last_Name = request('Last_Name');
                $Client->Email = request('Email');
                $Client->First_Name = request('First_Name');
                $Client->Number_phone = request('Phone');
                $Client->Balance = request('Balance');
                $id_devise=request('devise'); 
                $devise = devise::where('id' , $id_devise)->first(['Name'])->Name;
                $Client->Currency = $devise;
                $Client->Debtor=0;
                $Client->Creditor=0;
                $User = User::where('id', session('id'))->first();
                
                $Client->Statement='انشئ من طرف - Created by '.$User->First_Name . ' ' . $User->Last_Name;
               
                 $email = client::where('id', $edit)->first(['Email'])->Email;
                 
                $User=User::where('email',$email)->first();
                $User->First_Name = request('First_Name');
                $User->Last_Name = request('Last_Name');
                $User->email = request('Email');
                $User->Phone = request('Phone');
               
              
                $User->save();
                $Client->save();


                return redirect($Lang.'/client')->with('success_delete', __('auth.editClient'));
            }
        } else {
            $request->validate([
                'Email' => 'required|max:255|email',
                'Last_Name' => 'required',
                'First_Name' => 'required',
                'Password' => 'required|min:6|max:255',
                'Password_verif' =>'required|min:6|max:255|same:Password',
                'Phone' => 'required|numeric',
                'Balance' => 'required|numeric',
                'devise' => 'required',
                
            ]);

            $User = User::where('email', request('Email'))->first();
            if ($User) {
                return redirect($Lang.'/client')->with('error', __('auth.existAccount'));
            } else {


                $Client = new client();
                $Client->Last_Name = request('Last_Name');
              
                $Client->Email = request('Email');
                $Client->First_Name = request('First_Name');
                $Client->Number_phone = request('Phone');
                $Client->Balance = request('Balance');
                $id_devise=request('devise'); 
                $Client->currency_id=request('devise'); 
                $devise = devise::where('id' , $id_devise)->first(['Name'])->Name;
                $Client->Currency = $devise;
                $Client->Debtor=0;
                $Client->Creditor=0;
                $User = User::where('id', session('id'))->first();
                
                $Client->Statement='انشئ من طرف - Created by '.$User->First_Name . ' ' . $User->Last_Name;
                $Client->Activation = 1;
                $User = new User();
                $User->First_Name = request('First_Name');
                $User->Last_Name = request('Last_Name');
                $User->email = request('Email');
                $User->Phone = request('Phone');
                $User->Role = 'Client';
                $User->password = bcrypt(request('Password'));
                $User->Activation = 1;
                $User->image = 'avatar.png';

                $User->save();
                $Client->save();
                FacadesMail::to(request('Email'))->send(new EmailVerificationMail($User));

                return redirect($Lang.'/client');
            }
        }
    }

    public function deleteClient($id, $Lang)
    {
        $Client = client::where('id', $id)->first();
        $email = client::where('id', $id)->first(['Email'])->Email;

        if ($Client->Activation == 1) {
            $Client->Activation = 0;
            $Client->save();
        } elseif ($Client->Activation == 0) {
            $Client->Activation = 1;
            $Client->save();
        }
        $User = User::where('email', $email)->first();
        if ($User) {
            if ($User->Activation == 1) {
                $User->Activation = 0;
                $User->save();
                return redirect($Lang.'/client')->with('success_delete', __('auth.deleteClient'));
           
                }
            if ($User->Activation == 0) {
                $User->Activation = 1;
                $User->save();
                return redirect($Lang.'/client')->with('success_restore', __('auth.restoreClient'));
               
            }
        } else {
            return redirect($Lang.'/client')->with('failed_delete', __('auth.failed_delete'));
        }}
}
