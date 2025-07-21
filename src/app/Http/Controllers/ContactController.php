<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
  public function index()
  {
    $categories = Category::all();
    return view('index', ['categories' => $categories]);
  }

  public function confirm(Request $request)
  {
    $contact = $request->only( 
      [ 'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel1',
        'tel2',
        'tel3',
        'address',
        'building',
        'detail',
      ]);
      $category = Category::find($request->category_id);

    return view('confirm', ['contact' => $contact, 'category' => $category]);
  }

  public function store(Request $request)
  {
    $contact = $request->only(
      [ 'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
      ]);
    Contact::create($contact);

    return view('thanks');
  }

        // 管理画面-リセット
    public function reset(Request $request)
    {
      $contacts = Contact::all();
      $categories = Category::all();

      return view('admin', compact('contacts', 'categories'));
    }

      // 管理画面-検索
    public function search(Request $request)
    {
      $contacts = Contact::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->get();
      $categories = Category::all();

      return view('admin', compact('contacts', 'categories'));
    }

    //  管理画面-削除
    public function destroy(Request $request) {

        Contact::find($request->id)->delete();

        return redirect('/admin')
            ->with('successMsg', 'Todoを削除しました');
    }


}
