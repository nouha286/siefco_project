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
        if(session()->has('role')) {
            return view('/devise')->with(['devise' => $devise]);
        }
        else{
            return redirect('/Sign');
        }
    }

    public function addDevise(Request $request)
    {
        $edit = request('edit_add');
        if($edit){
            $devise = Devise::where('id', $edit)->first();
            $devise->Name = request('Name');
            $devise->Dollar_Value = request('Value');
            $devise->save();
            return redirect('/devise');
        }
        else{
            $Devise = new devise();
            $Devise->Name = request('Name');
            $Devise->Dollar_value = request('Value');
            $Devise->Activation = 1;
            $Devise->save();
            return redirect('/devise')->with('success_delete','تم حذف العملة بنجاح'.request('edit_add')) ;
        }

    }

    public function deleteDevise($id)
    {
        $devise = Devise::where('id', $id)->first();
        $devise->Activation=0;
        $devise->save();
        return redirect('/devise')->with('success_delete','تم حذف العملة بنجاح');
    }

    public function editDevise() {}
}
