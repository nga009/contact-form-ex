<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
  
  public function index()
  {
    $categories = Category::all();
    return view('index', ['categories' => $categories]);
  }

  public function confirm(ContactRequest $request)
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

  // 登録
  public function store(Request $request)
  {
    // 修正ボタンだったら登録画面に戻る
    if ($request->has('back')) {
        // 修正ボタンが押された場合、入力画面に戻す
        return redirect('/')->withInput();
    }

    // 登録処理
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

  // 管理画面 初期
  public function reset(Request $request)
  {
    $contacts = Contact::Paginate(7)->withQueryString();
    $categories = Category::all();

    $param = [];
    return view('admin', ['contacts' => $contacts, 'categories' => $categories, 'param' => $param ]);
  }

    // 管理画面-検索
  public function search(Request $request)
  {
    $contacts = Contact::with('category')
    ->CategorySearch($request->category_id)
    ->KeywordSearch($request->keyword)
    ->GenderSearch($request->gender)
    ->CreatedAtSearch($request->created_at)
    ->paginate(7)
    ->withQueryString();

    //dd($request);
    $categories = Category::all();

    $param = [
      'category_id' => $request->category_id,
      'keyword' => $request->keyword,
      'gender' => $request->gender,
      'created_at' => $request->created_at,
    ];

    return view('admin', ['contacts' => $contacts, 'categories' => $categories, 'param' => $param ]);
  }

  //  管理画面-削除
  public function destroy(Request $request) {

      Contact::find($request->id)->delete();

      return redirect('/admin')
          ->with('successMsg', 'Todoを削除しました');
  }


}
