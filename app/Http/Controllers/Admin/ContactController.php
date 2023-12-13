<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $data['contacts'] = Contact::latest()->get();
        return view('admin.contact.index',$data);
    }

    public function destroy($id){
        $contact=Contact::find($id);
        if(!$contact){
            flash('Data Not Fount')->error();
            return redirect('/admin/contact');
        }
        $contact->delete();
        flash('Data Delete Success')->success();
        return redirect('/admin/contact');
    }
}
