<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Employees;
use App\Models\Client;
use App\Models\Operation_commercial;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (session()->has('role')) {
            $Admin = count(Admin::All());
            $Employee = count(Employees::All());
            $Client = count(Client::All());
            $Operation_commercial = count(Operation_commercial::All());
            return view('Dashboard')->with(['Admin' => $Admin , 'Employee' => $Employee , 'Client' => $Client , 'Operation_commercial' => $Operation_commercial]);
        }else
        {
            return redirect('Sign');
        }
    }
}
