<?php

namespace App\Http\Controllers;

use App\Model\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function create(Request $request)
    {
        $data=Settings::select('key','value')->get();
        return view('Admin.Settings/add',[
            'data'=>$data
        ]);
    }
    public function store(Request $request)
    {
        // return $request;
        $data=Settings::find(1);//Name
        $data->value=$request->name;
        $data->save();

        $data=Settings::find(2);//AD1
        $data->value=$request->ad1;
        $data->save();

        $data=Settings::find(3);//AD2
        $data->value=$request->ad2;
        $data->save();

        $data=Settings::find(4);//AD3
        $data->value=$request->ad3;
        $data->save();

        $data=Settings::find(5);//City
        $data->value=$request->city;
        $data->save();

        $data=Settings::find(6);//State
        $data->value=$request->state;
        $data->save();

        $data=Settings::find(7);//Pincode
        $data->value=$request->pincode;
        $data->save();
        $data=Settings::find(8);//Country
        $data->value=$request->country;
        $data->save();

        $data=Settings::find(9);//PAN NO
        $data->value=$request->panno;
        $data->save();

        $data=Settings::find(10);//GST NO
        $data->value=$request->gstno;
        $data->save();




        $request->session()->flash('status', 'Added Succesfully');
        return redirect('/admin/settings');
    }

}
