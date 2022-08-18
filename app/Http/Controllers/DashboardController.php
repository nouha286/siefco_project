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
            $Admin=User::where('Role','Admin')->get();
            $Admin = count($Admin);
            $Employee = count(Employees::All());
            $Client = count(Client::All());
            $Activ_Employe=User::where('Activation',2)->get();
            $Activ_Client=User::where('Activation',2)->where('Role','Client')->get();
            $User=User::where('id',session('id'))->first();

            $Operation_commercial = count(Comercial_Operation::All());
            return view('Dashboard')->with(['Admin' => $Admin , 'Employee' => $Employee , 'Client' => $Client , 'Operation_commercial' => $Operation_commercial,'Activ_Employe'=>$Activ_Employe,'Activ_Client'=>$Activ_Client,'User'=>$User]);
        }else
        {
            return redirect('Sign');
        }
    }

    public function Activer($id)
    { $devises=devise::where('Activation',1)->first();

        if($devises){
            $User=User::where('id', $id)->first();

            $User->save();
            if ( $User->Role=='Client') {
                $User->Activation=1;
               $Client=new Client;
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
               $User->save();

               return redirect('/Dashboard')->with('success_Activation','تم تفعيل الحساب بنجاح');
            }
            if ( $User->Role=='Employe') {
                $User->Activation=1;
                $Client=new Employees();
                $Client->Last_Name = User::where('id', $id)->first(['Last_Name'])->Last_Name;
                $Client->Email =User::where('id', $id)->first(['email'])->email;
                $Client->First_Name = User::where('id', $id)->first(['First_Name'])->First_Name;
                $Client->Number_phone = User::where('id', $id)->first(['Phone'])->Phone;

                $Client->Activation=1;

                $Client->save();
                $User->save();
                return redirect('/Dashboard')->with('success_Activation','تم تفعيل الحساب بنجاح');
             }
        }else return redirect('/Dashboard')->with('failed_Activation','المرجو اظافة عملة   ');

    }

    public function Supprimer($id)
    {
        $User=User::where('id', $id)->first(['Role'])->Role;

        if ( $User=='Client') {
            $User=User::where('id', $id)->first();
        $User->delete();
        return redirect('/Dashboard')->with('success_delete','تم حذف الحساب بنجاح');
    }
    if ( $User=='Employe') {
        $User=User::where('id', $id)->first();
    $User->delete();
    return redirect('/Dashboard')->with('success_delete','تم حذف الحساب بنجاح');
}
}
}
