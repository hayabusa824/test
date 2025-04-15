<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('category')->get();
        $categories = Category::all();
        return view('index', compact('contacts' ,'categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request ->only(['last_name', 'first_name', 'gender', 'email' ,'tel_1' ,'tel_2' ,'tel_3' ,'address' ,'building' ,'detail', 'category_id']);
        $category = $request->only(['content', 'category_id']);

        return view('confirm', compact('contact', 'category'));

    }

    public function store(ContactRequest $request)
    {
        $tel = $request->input('tel_1') . '-' . $request->input('tel_2') . '-' . $request->input('tel_3'); // 結合
        $contact = $request ->only(['last_name', 'first_name', 'gender', 'email' ,'tel_1' ,'tel_2' ,'tel_3' ,'address' ,'building' ,'detail', 'category_id']);
        $contact['tel'] = $tel; // 結合した電話番号を追加
        $category = $request->only(['category_id','content']);
        Contact::create($contact);
        return view('thanks');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect('/admin');
    }
}