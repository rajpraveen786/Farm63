<?php

namespace App\Http\Controllers;

use App\Mail\Newsletter as MailNewsletter;
use App\Model\Logger;
use App\Model\Newsletter;
use App\Model\User;
use Illuminate\Http\Request;


use Validator;
use Storage;
use Str;
use File;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $data = Newsletter::where('status', 1)->where('sent', 0)->where('datetime', '<=', date('d/m/Y h:i a'))->get();
        for ($i = 0; $i < $data->count(); $i++) {
            $datax = Newsletter::find($data[$i]->id);
            $img = strlen($datax->type['loc']) > 0 ? $datax->type['loc'] : '/storage/img/oilemail.jpg';
            // return env('APP_URL') . $img;
            $userid = json_decode($datax->members);
            for ($j = 0; $j < count($userid); $j++) {
                $user = User::find($userid[$j]);
                Mail::to($user->email)->send(new MailNewsletter($datax,$user));
            }
            // $datax->sent=1;
            $datax->save();
        }

        $data = Newsletter::select('title', 'status', 'sent', 'id')->orderBy('datetime', 'desc');
        if ($request->title) {
            $data = $data->where('title', 'LIKE', '%' . $request->name . '%');
        }
        if (!is_null($request->status) && $request->status >= 0) {
            $data = $data->where('status', $request->status);
        }
        if (!is_null($request->sent) && $request->sent >= 0) {
            $data = $data->where('sent', $request->sent);
        }
        $data = $data->paginate(20);
        return view('Admin.Newsletter.list', ['data' => $data]);
    }

    public function create(Request $request)
    {
        return view('Admin.Newsletter.add');
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'subject' => 'required|max:255',
            'content' => 'required',
            'loc' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ], [
            'title.nullable' => 'Please enter the Title',
            'subject.nullable' => 'Please enter the Subject',
            'content.nullable' => 'Please enter the Body of the mail',
            'loc.required' => 'Please upload the image',
            'loc.mimes' => 'Please upload the image as jpeg,png,jpg,gif,svg,webp',
            'loc.max' => 'Image Size Mus be maximum 5 mb',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }


        $x['loc'] = '';
        if ($request->file('loc')) {
            while (1) {
                $strrand = Str::random(16);
                if (strlen($x['loc']) == 0) {
                    if (!Storage::disk('public')->has('newsletter/' . $strrand . '.' . $request->file('loc')->getClientOriginalExtension())) {
                        $image = $request->file('loc');
                        $newfilename = $strrand . "." . $request->file('loc')->getClientOriginalExtension();
                        Storage::disk('public')->put('newsletter/' . $newfilename, File::get($image));
                        $x['loc'] = 'storage/newsletter/' . $newfilename;
                    }
                }
                if (strlen($x['loc']) > 0) {
                    break;
                }
            }
        }

        $userid = User::where('subscribe', 1)->pluck('id');
        $data = new Newsletter;
        $data->title = $request->title ?? '';
        $data->subject = $request->subject ?? '';
        $data->template = $request->template ?? 1;
        $data->content = $request->content ?? '';
        $data->type = $x;
        $data->members = json_encode($userid);
        $data->datetime = $request->datetime;
        $data->status = $request->status ?? 0;


        $data->save();




        $logdata = new Logger();
        $logdata->addLog(0, 'News Letter', null, $data);

        $request->session()->flash('status', 'Added Succesfully');
        return redirect('/admin/newsletter');
    }

    public function show($id, Request $request)
    {
        try {
            $data = Newsletter::find(decrypt($id));
            if ($data) {
                return view('Admin.Newsletter.view', ['data' => $data]);
            } else {
                $request->session()->flash('error', 'Sorry Newsletter not found');
            }
        } catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/admin/newsletter');
    }
    public function edit($id, Request $request)
    {
        $data = Newsletter::find(decrypt($id));
        return view('Admin.Newsletter/edit', [
            'data' => $data,
        ]);
    }
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'subject' => 'required|max:255',
            'content' => 'required',
            'loc' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ], [
            'title.nullable' => 'Please enter the Title',
            'subject.nullable' => 'Please enter the Subject',
            'content.nullable' => 'Please enter the Body of the mail',
            'loc.required' => 'Please upload the image',
            'loc.mimes' => 'Please upload the image as jpeg,png,jpg,gif,svg,webp',
            'loc.max' => 'Image Size Mus be maximum 5 mb',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        $data = Newsletter::find(decrypt($id));

        $x = $data->type;
        if ($request->loc) {
            if (strlen($x['loc']) > 0) {
                File::delete($x['loc']);
            }
            $x['loc'] = '';
            while (1) {
                $strrand = Str::random(16);
                if (!Storage::disk('public')->has('newsletter/' . $strrand . '.' . $request->file('loc')->getClientOriginalExtension())) {
                    $image = $request->file('loc');
                    $newfilename = $strrand . "." . $request->file('loc')->getClientOriginalExtension();
                    Storage::disk('public')->put('newsletter/' . $newfilename, File::get($image));
                    $x['loc'] = 'storage/newsletter/' . $newfilename;
                    break;
                }
            }
        }

        $userid = User::where('subscribe', 1)->pluck('id');
        $olddata = $data;

        $data->title = $request->title ?? '';
        $data->subject = $request->subject ?? '';
        $data->template = $request->template ?? 1;
        $data->content = $request->content ?? '';
        $data->type = $x;
        $data->members = json_encode($userid);
        $data->datetime = $request->datetime;
        $data->status = $request->status ?? 0;

        $data->save();


        if ($data->getChanges()) {
            $logdata = new Logger();
            $logdata->addLog(1, 'News Letter', $olddata, json_encode($data->getChanges()));
        }

        $request->session()->flash('status', 'Edited Succesfully');
        return redirect('/admin/newsletter');
    }
    public function destroy(Request $request, $id)
    {
        $data = Newsletter::find(decrypt($id));
        $logdata = new Logger();
        $logdata->addLog(2, 'News Letter', null, $data);
        File::delete($data->loc);
        $data->delete();
        $request->session()->flash('status', 'Deleted Succesfully');
        return redirect('/admin/newsletter');
    }
}
