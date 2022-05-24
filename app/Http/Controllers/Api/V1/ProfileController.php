<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Model\Address;
use App\Model\Orders;
use App\Model\User;
use Illuminate\Http\Request;
use Validator;

class ProfileController extends Controller
{
    /**
     * @group Profile - Address
     * List
     * @response 200 {
     *  "success": true,
     *  "message": "Sucess",
     *  "data": {
     *          "id":"1",
     *          "name":"xxxxxx",
     *          "email":"xxxxxx@gmail.com",
     *          "phno":"88xxxxxxx1",
     *          "token":"xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
     *      }
     * }
     * @response 400 {
     *  "success": false,
     *  "message": "",
     *  "data": {
     *          "email":["error"],
     *          "password":["error"],
     *      }
     * }
     */
    public function addresslist(Request $request)
    {
        $data = Address::where('uid', $request->user()->id)->get();
        return response()->json([
            'success' => true,
            'title' => '',
            'message' => '',
            'data' => $data,
        ], 200);
    }

    /**
     * @group Profile - Address
     * Add
     * @response 200 {
     *  "success": true,
     *  "message": "Sucess",
     *  "data": {
     *          "id":"1",
     *          "name":"xxxxxx",
     *          "email":"xxxxxx@gmail.com",
     *          "phno":"88xxxxxxx1",
     *          "token":"xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
     *      }
     * }
     * @response 400 {
     *  "success": false,
     *  "message": "",
     *  "data": {
     *          "email":["error"],
     *          "password":["error"],
     *      }
     * }
     */

    public function addressadd(Request $request)
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
            return response()->json([
                'success' => false,
                'title' => 'Validation error',
                'message' => 'please check the fields',
                'data' => $validate->errors(),
            ], 400);
        }

        $data = new Address();
        $data->uid = $request->user()->id;
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
            Address::where('uid', $request->user()->id)->update(['default' => 0]);
            $data->default = 1;
        } else {
            $data->default = 0;
        }
        $data->save();


        return response()->json([
            'success' => true,
            'title' => 'Address Added',
            'message' => 'Address added successfully',
            'data' => null,
        ], 200);
    }


    public function addressview(Request $request)
    {
        $data = Address::where('uid', $request->user()->id)->find($request->id);

        if ($data) {

            return response()->json([
                'success' => true,
                'message' => 'Fetched Data',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Product Found',
                'data' => $data,
            ], 401);
        }
    }

    /**
     * @group Profile - Address
     * Edit
     * @response 200 {
     *  "success": true,
     *  "message": "Sucess",
     *  "data": {
     *          "id":"1",
     *          "name":"xxxxxx",
     *          "email":"xxxxxx@gmail.com",
     *          "phno":"88xxxxxxx1",
     *          "token":"xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
     *      }
     * }
     * @response 400 {
     *  "success": false,
     *  "message": "",
     *  "data": {
     *          "email":["error"],
     *          "password":["error"],
     *      }
     * }
     */

    public function addressupdate(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id' => 'required',
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
            return response()->json([
                'success' => false,
                'title' => 'Validation error',
                'message' => 'please check the fields',
                'data' => $validate->errors(),
            ], 400);
        }


        $data = Address::find($request->id);
        $data->uid = $request->user()->id;
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
            Address::where('uid', $request->user()->id)->update(['default' => 0]);
            $data->default = 1;
        } else {
            $data->default = 0;
        }
        $data->save();


        return response()->json([
            'success' => true,
            'title' => 'Address Editted',
            'message' => 'Address Editted successfully',
            'data' => null,
        ], 200);
    }

    /**
     * @group Profile - Address
     * Remove
     * @response 200 {
     *  "success": true,
     *  "message": "Sucess",
     *  "data": {
     *          "id":"1",
     *          "name":"xxxxxx",
     *          "email":"xxxxxx@gmail.com",
     *          "phno":"88xxxxxxx1",
     *          "token":"xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx",
     *      }
     * }
     * @response 400 {
     *  "success": false,
     *  "message": "",
     *  "data": {
     *          "email":["error"],
     *          "password":["error"],
     *      }
     * }
     */
    public function addressdestroy(Request $request)
    {
        $data = Address::find($request->id);
        $data->delete();

        return response()->json([
            'success' => true,
            'title' => 'Address Deleted',
            'message' => 'Address deleted successfully',
            'data' => null,
        ], 200);
    }


    /**
     * @group Profile - Orders
     * List
     */

    public function ordersindex(Request $request)
    {
        $type = $request->type ?? 0;
        $data = Orders::select('created_at', 'invno', 'total', 'id', 'status', 'paystatus', 'paytype')->with('ordersub')->where('uid', $request->user()->id)->orderBy('id', 'desc');
        if ($request->orderno) {
            $data = $data->where('invno', 'LIKE', '%' . $request->orderno . '%');
        }
        if ($request->type && in_array($request->type, [0, 1, 2, 3, 4, 5, 6, 7])) {
            $data = $data->where('status', $request->type);
        }
        $data = $data->paginate(10);
        // return $data;

        return response()->json([
            'success' => true,
            'title' => '',
            'message' => '',
            'data' => $data,
        ], 200);
    }

    /**
     * @group Profile - Orders
     * Show
     */
    public function ordersshow(Request $request)
    {
        $data = Orders::with('ordersub')->where('uid', $request->user()->id)->find($request->id);
        if ($data) {
            return response()->json([
                'success' => true,
                'message' => '',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'title' => 'Oops!!',
                'message' => 'No Order Found',
                'data' => null,
            ], 200);
        }
    }
}
