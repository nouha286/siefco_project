<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Employees;
use App\Models\Client;
use App\Models\User;
use App\Models\devise;
use App\Models\Comercial_Operation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (session()->has('role')) {
            $Admin = count(Admin::All());
            $Employee = count(Employees::All());
            $Client = count(Client::All());
            $User=User::where('Activation',2)->get();

            $Operation_commercial = count(Comercial_Operation::All());
            return view('Dashboard')->with(['Admin' => $Admin , 'Employee' => $Employee , 'Client' => $Client , 'Operation_commercial' => $Operation_commercial,'User'=>$User]);
        }else
        {
            return redirect('Sign');
        }
    }

    public function Activer($id)
    {
        $User=User::where('id', $id)->first(); 
        $User->Activation=1;
        $User->save();
        if ( $User->Role=='Client') {
           $Client=new Client;
           $Client->image='';
           $Client->Last_Name = User::where('id', $id)->first(['Last_Name'])->Last_Name;
           $Client->Email =User::where('id', $id)->first(['email'])->email;
           $Client->First_Name = User::where('id', $id)->first(['First_Name'])->First_Name;
           $Client->Number_phone = User::where('id', $id)->first(['Phone'])->Phone;
           $Client->Balance = 0;
           $devise = devise::where('id' , 1)->first(['Name'])->Name;
           $Client->Currency = $devise;
           $Client->currency_id = 1;
           $Client->Activation=1;
           $Client->Debtor=0;
           $Client->Creditor=0;
           $Client->Statement='Activer par'.session('role');
           $Client->save();
           return redirect('/Dashboard')->with('success_Activation','تم تفعيل العملة بنجاح');
        }
        if ( $User->Role=='Employe') {
            $Client=new Employees();
            $Client->Last_Name = User::where('id', $id)->first(['Last_Name'])->Last_Name;
            $Client->Email =User::where('id', $id)->first(['email'])->email;
            $Client->First_Name = User::where('id', $id)->first(['First_Name'])->First_Name;
            $Client->Number_phone = User::where('id', $id)->first(['Phone'])->Phone;
          
            $Client->Activation=1;
          
            $Client->save();
            return redirect('/Dashboard')->with('success_Activation','تم تفعيل العملة بنجاح');
         }
    }

    public function Supprimer($id)
    {
        $User=User::where('id', $id)->first(['Role'])->Role; 
       
        if ( $User=='Client') {
            $Client=Client::where('id', $id)->first(); 
        $Client->delete();
        return redirect('/Dashboard')->with('success_delete','تم حذف العملة بنجاح');
    }
    if ( $User=='Employe') {
        $Employee=Employees::where('id', $id)->first(); 
    $Employee->delete();
    return redirect('/Dashboard')->with('success_delete','تم حذف العملة بنجاح');
}
}
}