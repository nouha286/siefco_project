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
        $Client=Client::all();

    
            if (session()->has('role_client')) {
                return view('/interface_client')->with(['operation'=>$operation]);
            }
            else{
                return redirect('/Sign');
            }
    }
}
