<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comercial_Operation;
use App\Models\devise;
use App\Models\client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as FacadesMail;
use App\Mail\EmailVerificationMail;

class OperationCommercialController extends Controller
{
    public function index()
    {
        $devise = devise::where('Activation' , 1)->get();
        $comercial_Operation = Comercial_Operation::all();
        $Comercial_Operation = Comercial_Operation::where('Activation' , 1)->get();
        $client = client::where('Activation' , 1)->get();
        if(session()->has('role')) {
            return view('/operation_commercial')->with(['comercial_Operation' => $comercial_Operation , 'Comercial_Operation' => $Comercial_Operation , 'client' => $client,'devise'=>$devise]);
        }
        else{
            return redirect('/Sign');
        }
    }

    public function addOperation(Request $request)
    { $edit=request('Id');
        if ($edit) {
            $Comercial_Operation = Comercial_Operation::where('id', $edit)->first();
            $Comercial_Operation->Name=request('Name');
        $Comercial_Operation->Dollar_Value=request('Value');
       
        
        $Comercial_Operation->save();

        return redirect('/Comercial_Operation');
      
        }else {
            $Comercial_Operation = new Comercial_Operation();
           
            $id=request('Client_id');
            $Comercial_Operation->Client_id=$id;
            $client_First_Name=client::where('id',$id)->first(['First_Name'])->First_Name;
            $client_Last_Name=client::where('id',$id)->first(['Last_Name'])->Last_Name;
            $Comercial_Operation->Client_Name=$client_First_Name.''.$client_Last_Name;
            $Comercial_Operation->Debtor=request('Debtor');
            $Comercial_Operation->Creditor=request('Creditor');
            $client_Balance=client::where('id',$id)->first(['Balance'])->Balance;
            $Comercial_Operation->Balance=$client_Balance+request('Debtor')-request('Creditor');
            $Comercial_Operation->Statement='سجل   '.session('First_Name').' '.session('Last_Name').' عملية لاجل الزبون: السيد(ة) '.$client_First_Name.' '.$client_Last_Name;
            $id_devise=request('devise'); 
            $devise = devise::where('id' , $id_devise)->first(['Name'])->Name;
            $Comercial_Operation->Currency = $devise;
            $Comercial_Operation->currency_id=$id_devise;
            $Comercial_Operation->Emloyee_Name=session('First_Name').' '.session('Last_Name');
            $Comercial_Operation->Activation=1;
            $client=client::where('id',$id)->first();
            $client->Balance=$client_Balance+request('Debtor')-request('Creditor');
            $client->save();
            $Comercial_Operation->save();
            return redirect('/operation_commercial')->with('success_delete','تم اظافة العملية بنجاح'.request('edit_add')) ;
        }
        
    }

    public function deleteOperation($id)
    {
        $Comercial_Operation = Comercial_Operation::where('id', $id)->first(); 
        if($Comercial_Operation->Activation==1)
        {
            $Comercial_Operation->Activation=0;
            $Comercial_Operation->save();
            return redirect('/operation_commercial')->with('success_delete','تم حذف العملية بنجاح');
        }

        elseif($Comercial_Operation->Activation==0)
        {
            $Comercial_Operation->Activation=1;
            $Comercial_Operation->save();
            return redirect('/devise')->with('success_restore','تم استرجاع العملية بنجاح');
        }
        
        
    }
}

