<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comercial_Operation;
use App\Models\client;
class interface_clientController extends Controller
{
    public function index()
    {
        $operation=Comercial_Operation::all();
        $Client=Client::where('id',session('id'))->first();
        $comptOperation=Comercial_Operation::where('Client_id',session('id'))->get();
        $comptOperation=count($comptOperation);

    
            if (session()->has('role_client')) {
                return view('/interface_client')->with(['operation'=>$operation,'Client'=>$Client,'comptOperation'=>$comptOperation]);
            }
            else{
                return redirect('/Sign');
            }
    }
}
