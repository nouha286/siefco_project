<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comercial_Operation;
use App\Models\client;
use App\Models\User;
class Operation_for_a_clientController extends Controller
{
    public function index($id, Request $request)
    {  
        $User=User::where('id',session('id'))->first();
        $operation=Comercial_Operation::where('Client_id',$id)->get();
        $request->session()->put('id_Client', $id);
        
        if (session()->has('role')) {
            return view('/Operation_for_a_client')->with(['operation'=>$operation,'User'=>$User]);
        }
        else{
            return redirect('/Sign');
        }
    }
}
