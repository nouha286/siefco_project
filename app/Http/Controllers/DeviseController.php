<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\devise;
use App\Models\User;
use Illuminate\Http\Request;

class DeviseController extends Controller
{
    public function index()
    {
        $devise = Devise::all();
        $devise_deleted = Devise::all();
        $User=User::where('id',session('id'))->first();

        if (session()->has('role')) {
            return view('/devise')->with(['devise' => $devise,'devise_deleted' => $devise_deleted,'User'=>$User]);
        } else {
            return redirect('/Sign');
        }
    }
    public function addDevise(Request $request)
    { 
        $request->validate([
            'Name' => 'required|max:255',
            'Value' => 'required',
            
           
            
        ]);
        
        $edit=request('Id');
        if ($edit) {
            $devise = Devise::where('id', $edit)->first();
            $devise->Name=request('Name');
        $devise->Dollar_Value=request('Value');
       
        
        $devise->save();

        return redirect('/devise');
      
        }else {
            $Devise = new devise();
            $Devise->Name = request('Name');
            $Devise->Dollar_value = request('Value');
            $Devise->Activation=1;
            $Devise->save();
            return redirect('/devise')->with('success_delete','تم اظافة العملة بنجاح'.request('edit_add')) ;
        }
        
    }

    public function deleteDevise($id)
    {
        $devise = Devise::where('id', $id)->first(); 
        if($devise->Activation==1)
        {
            $devise->Activation=0;
            $devise->save();
            return redirect('/devise')->with('success_delete','تم حذف العملة بنجاح');
        }

        elseif($devise->Activation==0)
        {
            $devise->Activation=1;
            $devise->save();
            return redirect('/devise')->with('success_restore','تم استرجاع العملة بنجاح');
        }
        
        
    }

    public function editDevise()
    {
         
       
    }
}