<?php

namespace App\Http\Controllers;

use App\Model\Address;
use App\Model\PinCode;
use Illuminate\Http\Request;
use Auth;
use Validator;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        $data = Address::where('uid', Auth::user()->id)->get();
        return view('Profile/Address/list', ['data' => $data]);
    }

    public function create(Request $request)
    {
        $pincode = PinCode::get();
        return view('Profile/Address/enter', ['pincode' => $pincode, 'url' => '/profile/address/new', 'title' => 'New Address', 'submit' => 'New Address']);
    }
    public function store(Request $request)
    {
        // return $request;
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phno' => 'required|max:255',
            'pincode' => 'required|max:255',
            'country' => 'required|max:255',
            'state' => 'required|max:255',
            'city' => 'required|max:255',
            'houseno' => 'required|max:255',
            'area' => 'required|max:255',
            'landmark' => 'max:255',
        ], [
            'name.required' => 'Please enter the Name',
            'phno.required' => 'Please enter the Phone Number',
            'pincode.required' => 'Please enter the Pincode',
            'country.required' => 'Please enter the Country',
            'state.required' => 'Please enter the State',
            'city.required' => 'Please enter the City',
            'houseno.required' => 'Please enter the House Number',
            'area.required' => 'Please enter the Area',
            'landmark.required' => 'Please enter the LandMark',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $data = new Address;
        $data->uid = Auth::user()->id;
        $data->pid = $request->pid;
        $data->name = $request->name;
        $data->phno = $request->phno;
        $data->pincode = $request->pincode;
        $data->country = $request->country;
        $data->state = $request->state;
        $data->city = $request->city;
        $data->houseno = $request->houseno;
        $data->area = $request->area;
        $data->landmark = $request->landmark;
        if ($request->default) {
            Address::where('uid', Auth::user()->id)->update(['default' => 0]);
            $data->default = 1;
        } else {
            $data->default = 0;
        }
        $data->save();
        $request->session()->flash('status', 'Added Succesfully');
        return redirect('/profile/address');
    }


    public function edit($id, Request $request)
    {
        $data = Address::find(decrypt($id));
        $pincode = PinCode::get();
        return view('Profile/Address/enter', ['pincode' => $pincode, 'data' => $data, 'url' => '/profile/address/edit/' . encrypt($data->id), 'title' => 'Edit Address', 'submit' => 'Edit Address']);
    }
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'phno' => 'required|max:255',
            'pincode' => 'required|max:255',
            'country' => 'required|max:255',
            'state' => 'required|max:255',
            'city' => 'required|max:255',
            'houseno' => 'required|max:255',
            'area' => 'required|max:255',
            'landmark' => 'max:255',
        ], [
            'name.required' => 'Please enter the Name',
            'phno.required' => 'Please enter the Phone Number',
            'pincode.required' => 'Please enter the Pincode',
            'country.required' => 'Please enter the Country',
            'state.required' => 'Please enter the State',
            'city.required' => 'Please enter the City',
            'houseno.required' => 'Please enter the House Number',
            'area.required' => 'Please enter the Area',
            'landmark.required' => 'Please enter the LandMark',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        $data = Address::find(decrypt($id));
        $data->pid = $request->pid;
        $data->name = $request->name;
        $data->phno = $request->phno;
        $data->pincode = $request->pincode;
        $data->country = $request->country;
        $data->state = $request->state;
        $data->city = $request->city;
        $data->houseno = $request->houseno;
        $data->area = $request->area;
        $data->landmark = $request->landmark;
        $data->save();
        $request->session()->flash('status', 'Edited Succesfully');
        return redirect('/profile/address');
    }
    public function destroy(Request $request, $id)
    {
        $data = Address::find(decrypt($id));
        $data->delete();
        $request->session()->flash('status', 'Deleted Succesfully');
        return redirect('/profile/address');
    }
}
