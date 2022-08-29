<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comercial_Operation;
use App\Models\client;
use App\Models\User;
use PDF;
use Elibyy\TCPDF\Facades\TCPDF;

class PDFController extends Controller
{
    public function index()
    {
        $operation = Comercial_Operation::all();
        $Client = Client::where('id',session('id_Client'))->first();
        $comptOperation = Comercial_Operation::where('Client_id',session('id_Client'))->get();
        $comptOperation = count($comptOperation);
        $User = User::where('id',session('id'))->first();

        $sumDebtor = Comercial_Operation::where('Client_id', session('id_Client'))->sum('Debtor');
        $sumCreditor = Comercial_Operation::where('Client_id', session('id_Client'))->sum('Creditor');
        $sumBalance = $Client->Balance;

        if (session()->has('role_client')) {
            return view('/SIEFCO')->with(['operation'=>$operation,'Client'=>$Client,'comptOperation'=>$comptOperation,'User'=>$User, 'sumDebtor'=>$sumDebtor, 'sumCreditor'=>$sumCreditor, 'sumBalance'=>$sumBalance]);
        }
        else{
            return redirect('/Sign');
        }
    }

    public function generatePDF()
    {   
        $operation = Comercial_Operation::all();
        $Client = Client::where('id',session('id_Client'))->first();
        $comptOperation = Comercial_Operation::where('Client_id',session('id_Client'))->get();
        $comptOperation = count($comptOperation);
        $User = User::where('id',session('id'))->first();

        $sumDebtor = Comercial_Operation::where('Client_id', session('id_Client'))->sum('Debtor');
        $sumCreditor = Comercial_Operation::where('Client_id', session('id_Client'))->sum('Creditor');
        $sumBalance = $Client->Balance;

        // $pdf = PDF::loadView('SIEFCO', ['operation'=>$operation,'Client'=>$Client,'comptOperation'=>$comptOperation,'User'=>$User, 'sumDebtor'=>$sumDebtor, 'sumCreditor'=>$sumCreditor, 'sumBalance'=>$sumBalance]);

        // return $pdf->download('SIEFCO.pdf');

        $filename = 'SIEFCO.pdf';

        $view = View('SIEFCO', ['operation'=>$operation,'Client'=>$Client,'comptOperation'=>$comptOperation,'User'=>$User, 'sumDebtor'=>$sumDebtor, 'sumCreditor'=>$sumCreditor, 'sumBalance'=>$sumBalance]);
        $html = $view->render();

    	$pdf = new TCPDF;

        $pdf::SetTitle('Facture SIEFCO');
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');

        $pdf::Output(public_path($filename), 'F');

        return response()->download(public_path($filename));
    }

  
}
