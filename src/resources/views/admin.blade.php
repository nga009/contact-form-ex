@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<style>
  svg.w-5.h-5 {
    /*paginateメソッドの矢印の大きさ調整のために追加*/
    width: 30px;
    height: 30px;
  }
</style>
@endsection

@section('header-nav')
<nav>
  <ul class="header-nav">
    <li class="header-nav__item">
      @if (Auth::check())
      <form class="form" action="/logout" method="post">
        @csrf
        <button class="header-nav__button">Logout</button>
      </form>
      @endif
    </li>
  </ul>
</nav>

@endsection

@section('content')
<div class="todo__content">
  <div class="section__title">
    <h2>Admin</h2>
  </div>
  <form class="search-form" action="/admin/search" method="post">
    @csrf
    <div class="search-form__item">
      <input class="search-form__item-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">
      <select class="search-form__item-select" name="gender">
            <option value="">性別</option>
            <option value="1">男性</option>
            <option value="2">女性</option>
            <option value="3">その他</option>
      </select>
      <select class="search-form__item-select" name="category_id">
            <option value="">お問い合わせの種類</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
      </select>
      <input class="search-form__item-date" type="date" name="created_at"　placeholder="年/月/日" value="{{ request('created_at') }}">
    </div>

    <div class="search-form__button">
      <button class="search-form__button-submit" type="submit">検索</button>
    </div>
  </form>

  <form class="search-form" action="/admin" method="get">
    @csrf
    <div class="search-form__button">
      <button class="search-form__button-reset" type="submit">リセット</button>
    </div>
  </form>
  <div class="todo-table">
    <div class="todo-table__header">
      <div class="todo-table__pagelink">
        {{ $contacts->appends($param)->links() }}
        
      </div>
    </div>
    <table class="todo-table__inner">
      <tr class="todo-table__row">
        <th class="todo-table__header">
          <span class="todo-table__header-span">お名前</span>
        </th>
        <th class="todo-table__header">
          <span class="todo-table__header-span">性別</span>
        </th>
        <th class="todo-table__header">
          <span class="todo-table__header-span">メールアドレス</span>
        </th>
        <th class="todo-table__header">
          <span class="todo-table__header-span">お問い合わせの種類</span>
        </th>
        <th>
        </th>
        <th>
        </th>
      </tr>
      @foreach( $contacts as $contact )
      <tr class="todo-table__row">
        <td class="todo-table__item">
          <span>{{$contact['last_name']}}</span>
          <span>{{$contact['first_name']}}</span>
        </td>
        <td class="todo-table__item">
          <span>
            @if($contact['gender'] == 1)
              男性
            @elseif($contact['gender'] == 2)
              女性
            @else
              その他
            @endif
          </span>
        </td>
        <td class="todo-table__item">
          <span>{{$contact['email']}}</span>
        </td>
        <td class="todo-table__item">
          <span>{{$contact['category']['name']}}</span>
        </td>
        <td class="todo-table__item">
          <!-- 詳細ボタン -->
          <label for="modal-{{$contact['id']}}" style="cursor:pointer; color:blue;">詳細</label>
          <!-- モーダル開閉制御用チェックボックス -->
          <input type="checkbox" id="modal-{{ $contact->id }}">
          <!-- モーダル本体 -->
          <div class="modal">
            <div class="modal-content">
              <!-- モーダルを閉じるボタン -->
              <label for="modal-{{ $contact->id }}" class="close-btn">&times;</label>
              <h3>詳細</h3>
              <table class="contact-detail__table">
                <tr>
                  <th>お名前</th>
                  <td>
                    <span>{{$contact['last_name']}}</span>
                    <span>{{$contact['first_name']}}</span>
                  </td>
                </tr>
                <tr>
                  <th>性別</th>
                  <td>
                    <span>
                      @if($contact['gender'] == 1)
                        男性
                      @elseif($contact['gender'] == 2)
                        女性
                      @else
                        その他
                      @endif
                    </span>
                  </td>
                </tr>
                <tr>
                  <th>メールアドレス</th>
                  <td>
                    <span>{{$contact['email']}}</span>
                  </td>
                </tr>
                <tr>
                  <th>電話番号</th>
                  <td>
                    <span>{{$contact['tel']}}</span>
                  </td>
                </tr>
                <tr>
                  <th>住所</th>
                  <td>
                    <span>{{$contact['address']}}</span>
                  </td>
                </tr>
                <tr>
                  <th>建物名</th>
                  <td>
                    <span>{{$contact['building']}}</span>
                  </td>
                </tr>
                <tr>
                  <th>お問い合わせの種類</th>
                  <td>
                    <span>{{$contact['category']['name']}}</span>
                  </td>
                </tr>
                <tr>
                  <th>お問い合わせ内容</th>
                  <td>
                    <p>{{$contact['detail']}}</p>
                  </td>
                </tr>
              </table>
              <div class="contact-detail__button">
                
                <form class="delete-form" action="/admin/delete" method="post">
                  @method('DELETE')
                  @csrf
                  <input type="hidden" name="id" value="{{$contact['id']}}">
                  <div class="delete-form__button">
                    <button class="delete-form__button-submit" type="submit">削除</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
