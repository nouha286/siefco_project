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
        $deviseForVersement = devise::where('Activation', 1)->get();
        $deviseForRetrait = devise::where('Activation', 1)->get();
        $deviseForDepot = devise::where('Activation', 1)->get();
        $comercial_Operation = Comercial_Operation::all();
        $Comercial_Operation = Comercial_Operation::where('Activation', 1)->get();
        $clientForDepot = client::where('Activation', 1)->get();
        $clientForRetrait = client::where('Activation', 1)->get();
        $emetteur = client::where('Activation', 1)->get();
        $destinataire = client::where('Activation', 1)->get();
        $destinataireExclu = client::where('Activation', 2)->get();
        $User = User::where('id', session('id'))->first();
        if (session()->has('role')) {
            return view('/operation_commercial')->with(['comercial_Operation' => $comercial_Operation, 'emetteur' => $emetteur, 'destinataire' => $destinataire, 'Comercial_Operation' => $Comercial_Operation, 'clientForRetrait' => $clientForRetrait, 'clientForDepot' => $clientForDepot, 'deviseForDepot' => $deviseForDepot, 'deviseForRetrait' => $deviseForRetrait, 'deviseForVersement' => $deviseForVersement, 'User' => $User, 'destinataireExclu' => $destinataireExclu]);
        } else {
            return redirect('/Sign');
        }
    }

    public function addOperation(Request $request, $Lang)
    {
        if (request('Depot')) {

            $request->validate([

                'Client_id' => 'required',
                'Creditor' => 'required|numeric',
               'statement'=>'required',
                'devise' => 'required',
                'Benifice' => 'required|numeric',

            ]);
            $Comercial_Operation = new Comercial_Operation();

            $id = request('Client_id');
            $Comercial_Operation->Client_id = $id;
            $client_First_Name = client::where('id', $id)->first(['First_Name'])->First_Name;
            $client_Last_Name = client::where('id', $id)->first(['Last_Name'])->Last_Name;
            $Comercial_Operation->Client_Name = $client_First_Name . ' ' . $client_Last_Name;
            $Comercial_Operation->Debtor = 0;
            $Comercial_Operation->receiver = '__';
            $Comercial_Operation->Creditor = request('Creditor');
            $client_Balance = client::where('id', $id)->first(['Balance'])->Balance;
            $Comercial_Operation->Balance = $client_Balance + request('Creditor')-request('Benifice');
            $Comercial_Operation->Statement = request('statement');
            $id_devise = request('devise');
            $devise = devise::where('id', $id_devise)->first(['Name'])->Name;
            $Comercial_Operation->Currency = $devise;
            $Comercial_Operation->currency_id = $id_devise;
            $User = User::where('id', session('id'))->first();
            $Comercial_Operation->Emloyee_Name = $User->First_Name . ' ' . $User->Last_Name;
            $Comercial_Operation->Activation = 1;
            $client = client::where('id', $id)->first();
            $Comercial_Operation->Benifice=request('Benifice');
            $client->Balance = $client_Balance + request('Creditor')-request('Benifice');
            $client->save();
            $Comercial_Operation->save();
            return redirect($Lang.'/operation_commercial')->with('success_delete', __('auth.add_operation'));
        }

        if (request('Retrait')) {

            // $request->validate([

            //     'Client_id' => 'required',
            //     'Creditor' => 'required|numeric',
            //     'Debtor' => 'required|numeric',
            //     'devise' => 'required',

            // ]);
            $request->validate([

                'Client_id' => 'required',
                'Debtor' => 'required|numeric',
               'statement'=>'required',
                'devise' => 'required',
                'Benifice' => 'required|numeric',

            ]);
            $Comercial_Operation = new Comercial_Operation();

            $id = request('Client_id');
            $Comercial_Operation->Client_id = $id;
            $client_First_Name = client::where('id', $id)->first(['First_Name'])->First_Name;
            $client_Last_Name = client::where('id', $id)->first(['Last_Name'])->Last_Name;
            $Comercial_Operation->Client_Name = $client_First_Name . ' ' . $client_Last_Name;
            $Comercial_Operation->Debtor = request('Debtor');
            $Comercial_Operation->Creditor = 0;
            $Comercial_Operation->receiver = '__';
            $client_Balance = client::where('id', $id)->first(['Balance'])->Balance;
            $Comercial_Operation->Balance = $client_Balance - request('Debtor')-request('Benifice');
            $Comercial_Operation->Statement = request('statement');
            $id_devise = request('devise');
            $devise = devise::where('id', $id_devise)->first(['Name'])->Name;
            $Comercial_Operation->Currency = $devise;
            $Comercial_Operation->currency_id = $id_devise;
            $User = User::where('id', session('id'))->first();
            $Comercial_Operation->Emloyee_Name = $User->First_Name . ' ' . $User->Last_Name;
            $Comercial_Operation->Activation = 1;
            $client = client::where('id', $id)->first();
            $Comercial_Operation->Benifice=request('Benifice');
            $client->Balance = $client_Balance - request('Debtor')-request('Benifice');
            $client->save();
            $Comercial_Operation->save();
            return redirect($Lang.'/operation_commercial')->with('success_delete', __('auth.add_operation'));
        }


        if (request('Versement')) {

           
            if (request('email')) {
                $request->validate([

                    'Client_id' => 'required',
                    'Verse' => 'required|numeric',
                   'statement'=>'required',
                    'devise' => 'required',
                    'Benifice' => 'required|numeric',
                    'email' => 'required|max:255|email',
                    'Last_Name' => 'required',
                    'First_Name' => 'required',
                    'phone' => 'required',
    
                ]);

                $User = User::where('email', request('email'))->first();
                if ($User) 
                {
                    return redirect($Lang.'/operation_commercial')->with('error', __('auth.existAccount'));
                } else 
                {
                    $Client = new client();
                    $Client->Last_Name = request('Last_Name');
                  
                    $Client->Email = request('email');
                    $Client->First_Name = request('First_Name');
                    $Client->Number_phone = request('phone');
                    $Client->Balance =0;
                    $id_devise=request('devise'); 
                    $Client->currency_id=request('devise'); 
                    $devise = devise::where('id' , $id_devise)->first(['Name'])->Name;
                    $Client->Currency = $devise;
                    $Client->Debtor=0;
                    $Client->Creditor=request('Verse');
    
                    $User = User::where('id', session('id'))->first();
                    
                    $Client->Statement='انشئ من طرف - Created by'.': '.$User->First_Name . ' ' . $User->Last_Name;
                    $Client->Activation = 2;
                   
    
                   
                    $Client->save();

                    $Comercial_Operation = new Comercial_Operation();
    
                    $id = request('Client_id');
                    $id_receiver = client::where('Email', request('email'))->first(['id'])->id;
                    $Comercial_Operation->Client_id = $id;
                    $client_First_Name = client::where('id', $id)->first(['First_Name'])->First_Name;
                    $client_Last_Name = client::where('id', $id)->first(['Last_Name'])->Last_Name;
                    $receiver_First_Name = client::where('id', $id_receiver)->first(['First_Name'])->First_Name;
                    $receiver_Last_Name = client::where('id', $id_receiver)->first(['Last_Name'])->Last_Name;
                    $Comercial_Operation->Client_Name = $client_First_Name . ' ' . $client_Last_Name;
                    $Comercial_Operation->Debtor = request('Verse');
                    $Comercial_Operation->Creditor = 0;
                    $Comercial_Operation->receiver = $receiver_First_Name . ' ' .  $receiver_Last_Name;
                    $client_Balance = client::where('id', $id)->first(['Balance'])->Balance;
                    $Comercial_Operation->Balance = $client_Balance - request('Verse')-request('Benifice');
                    $Comercial_Operation->Statement = request('statement');
                    $id_devise = request('devise');
                    $devise = devise::where('id', $id_devise)->first(['Name'])->Name;
                    $Comercial_Operation->Currency = $devise;
                    $Comercial_Operation->currency_id = $id_devise;
                    $User = User::where('id', session('id'))->first();
                    $Comercial_Operation->Emloyee_Name = $User->First_Name . ' ' . $User->Last_Name;
                    $Comercial_Operation->Activation = 1;
                    $Comercial_Operation->Benifice=request('Benifice');
                    $client = client::where('id', $id)->first();
                    $client->Balance = $client_Balance - request('Verse')-request('Benifice');
                    $client->save();
                    $Comercial_Operation->save();
                    return redirect($Lang.'/operation_commercial')->with('success_delete', __('auth.add_operation'));
                }

            }
            else{
                $request->validate([

                    'Client_id' => 'required',
                    'Verse' => 'required|numeric',
                   'statement'=>'required',
                    'devise' => 'required',
                    'Benifice' => 'required|numeric',
    
                ]);

                $Comercial_Operation = new Comercial_Operation();

                $id = request('Client_id');
                $id_receiver = request('receiver_id');
                $Comercial_Operation->Client_id = $id;
                $client_First_Name = client::where('id', $id)->first(['First_Name'])->First_Name;
                $client_Last_Name = client::where('id', $id)->first(['Last_Name'])->Last_Name;
                $receiver_First_Name = client::where('id', $id_receiver)->first(['First_Name'])->First_Name;
                $receiver_Last_Name = client::where('id', $id_receiver)->first(['Last_Name'])->Last_Name;
                $Comercial_Operation->Client_Name = $client_First_Name . ' ' . $client_Last_Name;
                $Comercial_Operation->Debtor = request('Verse');
                $Comercial_Operation->Creditor = 0;
                $Comercial_Operation->receiver = $receiver_First_Name . ' ' .  $receiver_Last_Name;
                $client_Balance = client::where('id', $id)->first(['Balance'])->Balance;
                $Comercial_Operation->Balance = $client_Balance - request('Verse')-request('Benifice');
                $Comercial_Operation->Statement = request('statement');
                $id_devise = request('devise');
                $devise = devise::where('id', $id_devise)->first(['Name'])->Name;
                $Comercial_Operation->Currency = $devise;
                $Comercial_Operation->currency_id = $id_devise;
                $User = User::where('id', session('id'))->first();
                $Comercial_Operation->Emloyee_Name = $User->First_Name . ' ' . $User->Last_Name;
                $Comercial_Operation->Activation = 1;
                $client = client::where('id', $id)->first();
                $Comercial_Operation->Benifice=request('Benifice');
                $client->Balance = $client_Balance - request('Verse')-request('Benifice');
                $client->save();
                $Comercial_Operation->save();
                return redirect($Lang.'/operation_commercial')->with('success_delete', __('auth.add_operation'));
            }




        }
    }
}
