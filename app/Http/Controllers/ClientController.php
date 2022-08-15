<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $client = Client::all();
        if(session()->has('role')) {
            return view('/client')->with(['client' => $client]);
        }
        else{
            return redirect('/Sign');
        }
    }
}
