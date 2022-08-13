<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\devise;
use Illuminate\Http\Request;

class DeviseController extends Controller
{
    public function index()
    {
        $devise = Devise::all();

        if (session()->has('role')) {
            return view('/devise')->with(['devise' => $devise]);
        } else {
            return redirect('/Sign');
        }
    }
    public function addDevise(Request $request)
    {
        $Devise = new devise();
        $Devise->Name = request('Name');
        $Devise->Dollar_value = request('Value');
        $Devise->save();
        return redirect('/devise');
    }

    public function deleteDevise($id)
    {
        $devise = Devise::where('id', $id)->first();
        $devise->delete();
        return redirect('/devise')->with('success_delete','تم حذف العملة بنجاح');
    }

    public function editDevise(Request $request)
    {
        if ($devise = Devise::where('id', 3)->first()) {
            $devise->Name=request('Name');
        $devise->Name=request('Value');
        $devise->save();

        return redirect('/devise')->with('success_delete','تم حذف العملة بنجاح');
        } ;
       
    }
}
