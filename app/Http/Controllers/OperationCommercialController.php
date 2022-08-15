<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comercial_Operation;
use App\Models\devise;
use App\Models\client;
use Illuminate\Http\Request;

class OperationCommercialController extends Controller
{
    public function index()
    {
        $comercial_Operation = Comercial_Operation::all();
        $devise = devise::where('Activation' , 1)->get();
        $client = client::where('Activation' , 1)->get();
        if(session()->has('role')) {
            return view('/operation_commercial')->with(['comercial_Operation' => $comercial_Operation , 'devise' => $devise , 'client' => $client]);
        }
        else{
            return redirect('/Sign');
        }
    }
}
