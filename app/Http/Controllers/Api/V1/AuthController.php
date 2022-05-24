<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Mail\NewRegistrationOTP;
use App\Model\OTP;
use App\Model\User;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Validator;
use Hash;
use Str;
class AuthController extends Controller
{

    /**
     * @group Authentication
     * Login.
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
     * @response 401 {
     *  "success": false,
     *  "message": "User Not Found",
     *  "data": {
     *          "email":["error"],
     *          "password":["error"],
     *      }
     * }
     */


    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ], [
            'email.required' => 'Please enter the Email Address or Phone Number',
            'password.required' => 'Please enter the Password',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'title' => 'Validation error',
                'message' => 'please check the fields',
                'data' => $validate->errors(),
            ], 400);
        }

        $user = User::where('email', $request->email)->orWhere('phno', $request->email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'title' => 'User not Found',
                'message' => 'no such information found',
                'data' => ['email' => ['No such user with email or password']],
            ], 401);
        }

        if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            $user = $request->user();
            $datax = User::select('id', 'name', 'email', 'phno','email_verified_at')->find($user->id);
            $datax['exp_date'] = date('Y-m-d H:i:s',strtotime('+14days -3 hours'));
            $datax['token'] = $user->createToken('apptoken')->accessToken;
            return response()->json([
                'success' => true,
                'title' => 'Success',
                'message' => '',
                'data' => $datax,
            ]);
        }


        return response()->json([
            'success' => false,
            'message' => 'Email/Phone Number or Password does not match the records',
            'data' => ['password' => ['No such user with email or password']],
        ], 401);
    }

 /**
     * @group Authentication
     * Regsiter
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
     *
     * @response 400 {
     *  "success": false,
     *  "message": "Validation data",
     *  "data": {
     *          "email":["error"],
     *          "password":["error"],
     *      }
     * }
     *
     */

    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email|email',
            'phno' => 'required|unique:users,phno|numeric|digits:10',
            'password' => 'required|min:7',
        ], [
            'name.required' => 'Please enter the Name',
            'email.required' => 'Please enter the Email',
            'email.unique' => 'Email has already been taken',
            'email.email' => 'Please enter a valid Email',
            'phno.unique' => 'Phone Number has already been taken',
            'phno.required' => 'Please enter the Phone Number',
            'phno.numeric' => 'Please enter a valid Phone Number',
            'phno.digits' => 'Phone Number must contain minimum 10 digits',
            'password.required' => 'Please enter the Password',
            'password.required_with' => 'Please enter Confirm Password',
            'password.same' => 'Password do not match',
            'password.min' => 'Password must be of minimum 6 digits',
        ]);
        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validate->errors(),
            ], 401);
        }
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phno = $request->phno;
        $data->password = Hash::make($request->password);
        $data->save();
        $code = new OTP();
        $code->uid = $data->id;
        $code->type = 0;
        $code->value = $data->email;
        $code->reason = 'Registration';
        while (1) {
            $codex=rand(10000,99999);
            $length = OTP::where('code', $codex)->where('expdate', '>=', date('Y-m-d H:i:s'))->count();
            if ($length == 0) {
                break;
            }
        }
        $code->code = $codex;
        $code->expdate = date('Y-m-d H:i:s', strtotime('+15 minutes'));
        $code->save();
        Mail::to($data->email)->send(new NewRegistrationOTP($code->code));

        $user = Auth::loginUsingId($data->id);
        $datax = User::select('id', 'name', 'email', 'phno')->find($user->id);
            $datax['exp_date'] = date('Y-m-d H:i:s',strtotime('+14days -3 hours'));
            $datax['token'] = $user->createToken('apptoken')->accessToken;
        return response()->json([
            'success' => true,
            'title' => '',
            'message' => 'success',
            'data' => $datax,
        ]);
    }


    /**
     * @group Authentication
     * Log out
     * @response 200 {
     *  "success": true,
     *  "message": "Logout Successfully",
     * @response 401 {
     *  "success": false,
     *  "message": "Unable to Logout",
     * }
     *
     */
    public function logout(Request $request)
    {
        if ($request->user()) {
            $user = $request->user()->token();
            $user->revoke();
            $user->delete();
            return response()->json([
                'success' => true,
                'message' => '',
                'message' => 'Logout Successfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => '',
                'message' => 'Unable to Logout',
            ], 401);
        }
    }

    /**
     * @group Authentication
     * OTP Verify
     * @bodyParam OTP string OTP Code
     *
     * @response 200 {
     *  "success": 1,
     * }
     *
     * @response 401 {
     *  "success": 0,
     *  "data": "Message/Incorrect OTP",
     * }
     */
    public function loginotpverifypost(Request $request){
        $otp=OTP::where('code',$request->otp)
                  ->where('uid',$request->user()->id)
                  ->where('reason','Registration')
                  ->orderBy('id','desc')
                  ->first();
        $x=[];
        if($otp){
            if($otp->expdate>=date('Y-m-d H:i:s')){
                $x['success']=1;
                $otp->status=1;
                $otp->save();
                $user=User::find($otp->uid);
                $user->email_verified_at=date('Y-m-d H:i:s');
                $user->save();
            }
            else{
                $x['success']=0;
                $x['data']='';
                $x['title']='';
                $x['message']='';
            }
        }
        else{
            $x['success']=0;
            $x['title']='';
            $x['message']='';
            $x['data']=['otp'=>['Incorrect OTP']];
        }
        return $x;
    }



    /**
     * @group Authentication
     * OTP Resend
     * @bodyParam UID string User ID
     *
     * @response 200 {
     *  "success": 1,
     * }
     *
     * @response 401 {
     *  "success": 0,
     *  "data": "Message/Incorrect OTP",
     * }
     */
    public function loginresentotp(Request $request){



        $data=User::find($request->uid);
        OTP::where('uid',$data->id)->where('reason','Registration')->delete();
        $code=new OTP();
        $code->uid=$data->id;
        $code->type=0;
        $code->value=$data->email;
        $code->reason='Registration';
        while (1) {
            $codex=rand(10000,99999);
            $length = OTP::where('code', $codex)->where('expdate', '>=', date('Y-m-d H:i:s'))->count();
            if ($length == 0) {
                break;
            }
        }
        $code->code=$codex;
        $code->expdate=date('Y-m-d H:i:s',strtotime('+15 minutes'));
        $code->save();
        Mail::to($data->email)->send(new NewRegistrationOTP($code->code));
        return 1;
    }


}
