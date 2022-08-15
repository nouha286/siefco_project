<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\devise;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $client = Client::all();
        $devise = devise::where('Activation' , 1)->get();
        if(session()->has('role')) {
            return view('/client')->with(['client' => $client , 'devise' => $devise]);
        }
        else{
            return redirect('/Sign');
        }
    }
}
