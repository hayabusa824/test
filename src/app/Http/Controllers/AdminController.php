<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
{
    $contacts = Contact::with('category')->get();
    $categories = Category::all();

    $contacts = Contact::Paginate(7); // 1ページあたり7件のデータを取得



    return view('admin', compact('contacts', 'categories'));
}

    public function search(Request $request)
{
    $keyword = $request->input('keyword');
    $category_id = $request->input('category_id');
    $gender = $request->input('gender');
    $created_at = $request->input('created_at');

    $contacts = Contact::with('category')
        ->keywordSearch($keyword)
        ->categorySearch($category_id)
        ->genderSearch($gender)
        ->createdAtSearch($created_at)
        ->paginate(7);

    $categories = Category::all();

    return view('admin', compact('contacts', 'categories', 'keyword', 'category_id','gender', 'created_at'));
}

    public function show($id)
{
    $contact = Contact::with('category')->findOrFail($id);
    $contact->gender_text = $contact->gender == 1 ? '男性' : '女性';

    return response()->json($contact);
}

}