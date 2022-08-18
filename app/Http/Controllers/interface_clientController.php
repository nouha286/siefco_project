<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comercial_Operation;
use App\Models\client;
use App\Models\User;
class interface_clientController extends Controller
{
    public function index()
    {
        $operation=Comercial_Operation::all();
        $Client=Client::where('id',session('id_Client'))->first();
        $comptOperation=Comercial_Operation::where('Client_id',session('id_Client'))->get();
        $comptOperation=count($comptOperation);
        $User=User::where('id',session('id'))->first();

    
            if (session()->has('role_client')) {
                return view('/interface_client')->with(['operation'=>$operation,'Client'=>$Client,'comptOperation'=>$comptOperation,'User'=>$User]);
            }
            else{
                return redirect('/Sign');
            }
    }
}
