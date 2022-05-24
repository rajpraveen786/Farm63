<?php

namespace App\Http\Controllers;

use App\Mail\NewRegistrationOTP;
use App\Mail\UserPasswordChange;
use App\Model\Address;
use App\Model\Cart;
use App\Model\Orders;
use App\Model\PinCode;
use App\Model\Products;
use App\Model\PromoCode;
use App\Model\User;
use App\Model\OTP;
use App\Model\Review;
use App\Model\SEO;
use App\Model\WishList;
use Auth;
use Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Artesaos\SEOTools\Facades\SEOTools;
use Validator;
use Str;


use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class Customer extends Controller
{

    public function register(Request $request){
        $validate = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email|email',
            'phno' => 'required|unique:users,phno|numeric|digits:10',
            'password' => 'required|required_with:password_confirmation|same:password_confirmation|min:7',
        ],[
            'name.required'=>'Please enter the Name',

            'email.required'=>'Please enter the Email',
            'email.unique'=>'Email has already been taken',
            'email.email'=>'Please enter a valid Email',

            'phno.unique'=>'Phone Number has already been taken',
            'phno.required'=>'Please enter the Phone Number',
            'phno.numeric'=>'Please enter a valid Phone Number',
            'phno.digits'=>'Phone Number must contain minimum 10 digits',

            'password.required'=>'Please enter the Password',
            'password.required_with'=>'Please enter Confirm Password',
            'password.same'=>'Password do not match',
            'password.min'=>'Password must be of minimum 7 digits',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $data=new User();
        $data->name=$request->name;
        $data->email=$request->email;
        $data->phno=$request->phno;
        $data->subscribe=$request->subscribe??0;
        $data->password=Hash::make($request->password);
        $data->save();

        $code=new OTP();
        $code->uid=$data->id;
        $code->type=0;
        $code->value=$data->email;
        $code->reason='Registration';

        while(1){
            $codex=rand(10000,99999);
            $length=OTP::where('code',$codex)->where('expdate','>=',date('Y-m-d H:i:s'))->count();
            if($length==0){
                break;
            }
        }
        $code->code=$codex;
        $code->expdate=date('Y-m-d H:i:s',strtotime('+15 minutes'));
        $code->save();
        Mail::to($data->email)->send(new NewRegistrationOTP($code->code));
        Auth::loginUsingId($data->id);



        $cart=Cart::where('uid',Auth::user()->id)->pluck('id')->toArray();
        $cartsession=session('cart');

        $user=Auth::user();

        $cart=Cart::where('uid',$user->id)->pluck('id')->toArray();
        $cartsession=session('cart');
        $xdata= array_diff($cartsession,$cart);
        for($i=0;$i<count($xdata);$i++){
            $findata=Cart::where('uid',$user->id)->where('pid',$xdata[$i])->first();
            if(!$findata){
                $data = new Cart;
                $data->uid =$user->id;
                $data->pid = $xdata[$i];
                $data->qty = 1;
                $data->save();
            }
        }
        $cart=Cart::where('uid',$user->id)->pluck('id')->toArray();
        session(['cart'=>$cart]);


        $wishlist=WishList::where('uid',Auth::user()->id)->pluck('id')->toArray();
        $wishlistsession=session('wishlist');
        $user=Auth::user();
        $xdata= array_diff($wishlistsession,$wishlist);
        // return $xdata;
        for($i=0;$i<count($xdata);$i++){
            $findata=WishList::where('uid',$user->id)->where('pid',$xdata[$i])->first();
            if(!$findata){
                $data = new WishList;
                $data->uid =$user->id;
                $data->pid = $xdata[$i];
                $data->qty = 1;
                $data->save();
            }
        }
        $wishlist=WishList::where('uid',$user->id)->pluck('id')->toArray();
        session(['wishlist'=>$wishlist]);
        return redirect('/otpverify');
    }



    public function profilehome(Request $request){
        $seo=SEO::where('page','Profile')->first();
        SEOTools::setTitle($seo->title);
        SEOTools::setDescription($seo->desc);
        SEOTools::opengraph()->setUrl(config('app.url').'/profile');
        SEOTools::setCanonical(config('app.url').'/profile');
        SEOTools::opengraph()->addProperty('type', 'ecommerce');
        SEOTools::jsonLd()->addImage(config('app.url').'/storage/logo.jpg');

        return view('Profile/home');
    }

    public function loginotpverify(Request $request){
        return view('Profile/Verify/LoginOTP');
    }
    public function loginresentotp(Request $request){
        $data=User::find(   );
        OTP::where('uid',$data->id)->where('reason','Registration')->delete();
        $code=new OTP();
        $code->uid=$data->uid;
        $code->type=0;
        $code->value=$data->email;
        $code->reason='Registration';
        while(1){
            $codex=rand(100000,999999);
            $length=OTP::where('code',$codex)->where('expdate','>=',date('Y-m-d H:i:s'))->count();
            if($length==0){
                break;
            }
        }
        $code->code=$codex;
        $code->expdate=date('Y-m-d H:i:s',strtotime('+15 minutes'));
        $code->save();
        Mail::to($data->email)->send(new NewRegistrationOTP($code->code));
        return 1;
    }

    public function loginotpverifypost(Request $request){
        $otp=OTP::where('code',$request->otp)
                  ->where('uid',Auth::user()->id)
                  ->where('reason','Registration')
                  ->orderBy('id','desc')
                  ->first();
        $x=[];
        if($otp){
            if($otp->expdate>=date('Y-m-d H:i:s')){
                $x['error']=0;
                $otp->status=1;
                $otp->save();
                $user=User::find($otp->uid);
                $user->email_verified_at=date('Y-m-d H:i:s');
                $user->save();
            }
            else{
                $x['error']=1;
                $x['errordata']='OTP Expired';
            }
        }
        else{
            $x['error']=1;
            $x['errordata']='Incorrect OTP';
        }
        return $x;
    }

    public function resetpassword(Request $request){
        return view('Profile/resetpass');
    }
    public function resetpasswordpost(Request $request){

        $validate = Validator::make($request->all(),[
            'oldpassword' => 'required|min:6|max:255',
            'password' => 'required|min:6|max:255|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|min:6|max:255',
        ],[
            'oldpassword.required'=>'Old Password is required',
            'oldpassword.max'=>'Maximum no of letter is 255',
            'oldpassword.min'=>'Minimum no of letter is 6',
            'password.required'=>'Old Password is required',
            'password.max'=>'Maximum no of letter is 255',
            'password.required_with'=>'Please Enter the Confirmation Password',
            'password.same'=>'Confirmation and Password do not match',
            'password_confirmation.required'=>'Confirmation Password is required',
            'password_confirmation.max'=>'Maximum no of letter is 255',
            'password_confirmation.min'=>'Minimum no of letter is 6',
        ]);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        $data=User::find(Auth::user()->id);
        if(!Hash::check($request->oldpassword,$data->password)){
            $x['oldpassword']='Password does not Match.';
            return back()->withInput()->withErrors($x);
        }

        $data->password=Hash::make($request->newpass);
        $data->save();
        Mail::to($data->email)->send(new UserPasswordChange());
        $request->session()->flash('status', 'Password changed Succesfully');
        return redirect('/profile');
    }


        /**
     * @group General
     * Get Area
     * @bodyParam pincode string Pincode
     * @response 200 {
     *  "success": true,
     *  "title": "",
     *  "message": "",
     *  "data": {}
     *
     * }
     * @response 200 {
     *  "success": false,
     *  "title": "Sorry",
     *  "message": "We dont serve the selected pincode.",
     *  "data": {}
     * }
     */

    public function getarea(Request $request){
        $data=PinCode::where('pincode',$request->pincode)->first();
         if($data){
            return response()->json([
                'success' => true,
                'title' => '',
                'message' => '',
                'data' => $data,
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'title' => 'Sorry',
                'message' => 'We dont serve the selected pincode.',
            ], 200);
        }
    }


        /**
     * @group General
     * Get Servicability
     * @bodyParam pincode string Pincode
     * @response 200 {
     *  "success": true,
     *  "title": "Hurrey",
     *  "message": "We are there to service",
     *  "data": {}
     *
     * }
     * @response 200 {
     *  "success": false,
     *  "title": "Sorry",
     *  "message": "We dont serve the selected pincode.",
     *  "data": {}
     * }
     */
    public function checkpincode(Request $request){
        $data=PinCode::where('pincode',$request->pincode)->first();
        if($data){
            return response()->json([
                'success' => true,
                'title' => 'Hurrey',
                'message' => 'We are there to service',
            ], 200);
        }
        else{

            return response()->json([
                'success' => false,
                'title' => 'No Servicability !!!',
                'message' => 'We dont service the area currently',
            ], 200);
        }
    }


    public function getpromocode(Request $request){
        $data=PromoCode::where('code',$request->name)
        ->where('status',1)
        ->orderBy('id','desc')
        ->first();

        $x=[];
        $x['error']=0;
        if($data){
            if($data->oneuse){
                $csub=Orders::where('pid',$data->id)->where('uid',Auth::user()->id)->count();
                if($csub!=0){
                    $x['error']=1;
                    $x['errordata']='PromoCode already used';
                    return $x;
                }
            }
            if($data->noofuse>0){
                $csub=Orders::where('pid',$data->id)->count();
                if($csub>=$data->noofuse){
                    $x['error']=1;
                    $x['errordata']='PromoCode has expired';
                    return $x;
                }
            }
            $x['data']=$data;
        }
        else{
            $x['error']=1;
            $x['errordata']='Sorry No Valid PromoCode';
        }
        return $x;
    }

    public function getaddress(Request $request){
        $data=Address::where('uid',Auth::user()->id)->with('costaddress')->get();
        $x=[];
        $x['error']=0;
        $x['data']=$data;
        return $x;
    }




    public function securityindex(Request $request){
        return view('Profile/LoginSecurity.list',);
    }
    public function nameedit(Request $request){
        return view('Profile/LoginSecurity/enter',['title'=>'Name','url'=>'/profile/security/name','submit'=>'Edit Name','type'=>'name','value'=>Auth::user()->name]);
    }
    public function nameeditpost(Request $request){
        $validate = Validator::make($request->all(),[
            'name' => 'required|min:6|max:255',
        ],[
            'name.required'=>'Name is required',
        ]);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $data=User::find(Auth::user()->id);
        $data->name=$request->name;
        $data->save();
        $request->session()->flash('status', 'Editted Succesfully');
        return redirect('/profile/security');
    }

    public function emailedit(Request $request){
        return view('Profile/LoginSecurity/enter',['title'=>'Email','url'=>'/profile/security/email','submit'=>'Edit Email','type'=>'email','value'=>Auth::user()->email]);
    }
    public function emaileditpost(Request $request){
        $validate = Validator::make($request->all(),[
            'name' => 'required|unique:users,email,'.Auth::user()->id.'|min:6|max:255',
        ],[
            'name.required'=>'Email is required',
            'name.unique'=>'Email is already taken',
        ]);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $data=User::find(Auth::user()->id);
        $data->email=$request->name;
        $data->email_verified_at=null;
        $data->save();
        $request->session()->flash('status', 'Editted Succesfully');
        return redirect('/profile/security');
    }

    public function phoneedit(Request $request){
        return view('Profile/LoginSecurity/enter',['title'=>'Phone','url'=>'/profile/security/phone','submit'=>'Edit Phone','type'=>'phone','value'=>Auth::user()->phno]);
    }
    public function phoneeditpost(Request $request){
        $validate = Validator::make($request->all(),[
            'name' => 'required|unique:users,phno,'.Auth::user()->id.'|numeric|digits:10',
        ],[
            'name.required'=>'Phone Number is required',
            'name.unique'=>'Phone Number is already taken',
        ]);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $data=User::find(Auth::user()->id);
        $data->phno=$request->name;
        $data->save();
        $request->session()->flash('status', 'Editted Succesfully');
        return redirect('/profile/security');
    }


        /**
     * @group Product
     * Post a Review
     * @bodyParam uid string User id
     * @bodyParam pid string Product id
     * @bodyParam review string review
     * @bodyParam rating string Rating
     * @response 200 {
     *  "success": true,
     *  "title": "Product Reviewed",
     *  "message": "Thank you for the review",
     *  "data": {}
     *
     * }
     * @response 400 {
     *  "success": false,
     *  "title": "",
     *  "message": "",
     *  "data": {}
     * }
     */

    public function postreview(Request $request){
        $data=new Review();
        $data->uid=FacadesAuth::user()->id;
        $data->pid=$request->pid;
        $data->review=$request->review;
        $data->rating=$request->rating;
        $data->status=1;
        $data->save();
        // return Review::with('customer')->find($data->id);
        return response()->json([
            'success' => true,
            'title' => 'Product Reviewed',
            'message' => 'Thank you for the review',
            'data' => Review::with('customer')->find($data->id),
        ], 200);
    }

    public function reportreview(Request $request){
        $data=Review::find($request->id);
        $data->status=2;
        $data->bid=$request->uid;
        $data->save();
    }

    public function changepincode(Request $request){
        $request->session()->put('address',$request->aid??null);
    }

    public function unsubscribe(Request $request,$data){
        try {
            // $data = User::where('email',decrypt($data))->first();
            // $data->subscribe=0;
            // $data->save();
            return view('Profile.unsubscribe');
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/');
    }

}
