<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use App\Notifications\ContactNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Brian2694\Toastr\Facades\Toastr;

class ContactController extends Controller
{
    public function contact(){
        return view('frontend.home.contact');
    }

    public function addContact(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|digits:11|numeric',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $contact = new Contact();
        $contact->name=$request->name;
        $contact->email=$request->email;
        $contact->mobile=$request->mobile;
        $contact->subject=$request->subject;
        $contact->message=$request->message;
        $contact->save();
        $users = User::where('role_id','1')->get();
        Notification::send($users, new ContactNotification($contact));
        Toastr::success('Contact successfully added', 'success');
        return redirect()->back();

    }
}
