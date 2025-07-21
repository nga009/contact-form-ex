@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="todo__content">
  <div class="section__title">
    <h2>Admin</h2>
  </div>
  <form class="search-form" action="/admin/search" method="post">
    @csrf
    <div class="search-form__item">
      <input class="search-form__item-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ old('keyword') }}">
      <select class="search-form__item-select" name="gender">
            <option value="">性別</option>
            <option value="1">男性</option>
            <option value="2">女性</option>
            <option value="3">その他</option>
      </select>
      <select class="search-form__item-select" name="category_id">
            <option value="">お問い合わせの種類</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" >{{ $category->name }}</option>
        @endforeach
      </select>
      <input class="search-form__item-date" type="date" name="created_at"　placeholder="年/月/日" value="{{ old('created_at') }}">
    </div>

    <div class="search-form__button">
      <button class="search-form__button-submit" type="submit">検索</button>
    </div>
  </form>

  <form class="search-form" action="/admin/reset" method="get">
    @csrf
    <div class="search-form__button">
      <button class="search-form__button-reset" type="submit">リセット</button>
    </div>
  </form>
  <div class="todo-table">
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
            @if($contact['gender'] === '1')
              男性
            @elseif($contact['gender'] === '2')
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
          <form class="delete-form" action="/admin/detail" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$contact['id']}}">
            <div class="delete-form__button">
              <button class="delete-form__button-submit" type="submit">詳細</button>
            </div>
          </form>
        </td>
        <td class="todo-table__item">
          <form class="delete-form" action="/admin/delete" method="post">
            @method('DELETE')
            @csrf
            <input type="hidden" name="id" value="{{$contact['id']}}">
            <div class="delete-form__button">
              <button class="delete-form__button-submit" type="submit">削除</button>
            </div>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
</div>
@endsection
