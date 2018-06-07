<?php

namespace App\Http\Controllers;

use Auth;
use Purifier;
use App\Inbox;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

class InboxController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except'=>'store']);
    }
    
    public function index()
    {   
        $inboxes = Inbox::latest()->paginate(10);
        return view('admin.contact.index',compact('inboxes'));
    }

    public function store(Request $request)
    {   
        $user = Auth::user();
        if ($user) {
            $this->validate($request, [
                'description' => 'required',
            ]);
            $pesan = Inbox::create([
                'email' => $user->email,
                'description' => Purifier::clean($request->description),
                'ip' => $request->getClientIp(),
                'user_id' => $user->id,
            ]);
        }else{
            $this->validate($request, [
                'email' => 'required',
                'description' => 'required',
                'g-recaptcha-response' => 'required|captcha',
            ]);
            $pesan = Inbox::create([
                'email' => Purifier::clean($request->email),
                'description' => Purifier::clean($request->description),
                'ip' => $request->getClientIp(),
            ]);
        }
        Mail::to('rarakirana07@gmail.com')->send(new Inbox($pesan));
        $request->session()->flash('pesan', 'Pesan berhasil dikirim.');
        return back();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'email' => 'required',
                'description' => 'required',
            ]);
        $contact = Inbox::find($id);
        $user = Auth::user();
        $contact->update([
            'email' => $request->email,
            'description' => $request->description,
            'user_id' => $user->id,
        ]);
       $request->session()->flash('status', 'Pesan anda berhasil dikirim.');
       return back();
    }

}
