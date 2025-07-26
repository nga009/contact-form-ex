@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact__content">
  <div class="contact__inner">
    <div class="contact__heading">
      <h2>Contact</h2>
    </div>
    <form class="form" action="/confirm" method="post">
      @csrf
      <div class="contact-table">
        <table class="contact-table__inner">
        <tr class="form__group">
          <th class="form__group-title">
            <span class="form__label--item">お名前</span>
            <span class="form__label--required">※</span>
          </th>
          <td class="form__group-content">
            <div class="form__input--text">
              <div class="form__input--text-name">
                <input type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name') }}" />
                <input type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name') }}" />
              </div>
            </div>
            <div class="form__error">
              @error('last_name')
              {{ $errors->first('last_name') }}
              @enderror
            </div>
            <div class="form__error">
              @error('first_name')
              {{ $errors->first('first_name') }}
              @enderror
            </div>
          </td>
        </tr>
        <tr class="form__group">
          <th class="form__group-title">
            <span class="form__label--item">性別</span>
            <span class="form__label--required">※</span>
          </th>
          <td class="form__group-content">
            <div class="form__input--radio">
              <input type="radio" name="gender" value="1" {{ old('gender',1) == 1 ? 'checked' : '' }}>男性
              <input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}>女性
              <input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}>その他
            </div>
            <div class="form__error">
              @error('gender')
              {{ $errors->first('gender') }}
              @enderror
            </div>
          </td>
        </tr>
        <tr class="form__group">
          <th class="form__group-title">
            <span class="form__label--item">メールアドレス</span>
            <span class="form__label--required">※</span>
          </th>
          <td class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="email" placeholder="例：test@example.com" value="{{ old('email') }}" />
            </div>
            <div class="form__error">
              @error('email')
              {{ $errors->first('email') }}
              @enderror
            </div>
          </td>
        </tr>
        <tr class="form__group">
          <th class="form__group-title">
            <span class="form__label--item">電話番号</span>
            <span class="form__label--required">※</span>
          </th>
          <td class="form__group-content">
            <div class="form__input--text">
              <div class="form__input--text-tel">
                <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}" />
                <span class="span__tel--hyphen">-</span>
                <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}" />
                <span class="span__tel--hyphen">-</span>
                <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}" />
              </div>
            </div>
            <div class="form__error">
              @error('tel1')
              {{ $errors->first('tel1') }}
              @enderror
            </div>
            <div class="form__error">
              @error('tel2')
              {{ $errors->first('tel2') }}
              @enderror
            </div>
            <div class="form__error">
              @error('tel3')
              {{ $errors->first('tel3') }}
              @enderror
            </div>
          </td>
        </tr>
        <tr class="form__group">
          <th class="form__group-title">
            <span class="form__label--item">住所</span>
            <span class="form__label--required">※</span>
          </th>
          <td class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="address" placeholder="例：東京都千代田区千駄ヶ谷1-2-3" value="{{ old('address') }}" />
            </div>
            <div class="form__error">
              @error('address')
              {{ $errors->first('address') }}
              @enderror
            </div>
          </td>
        </tr>
        <tr class="form__group">
          <th class="form__group-title">
            <span class="form__label--item">建物名</span>
            <span class="form__label--required"></span>
          </th>
          <td class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building') }}" />
            </div>
            <div class="form__error">
              @error('building')
              {{ $errors->first('building') }}
              @enderror
            </div>
          </td>
        </tr>
        <tr class="form__group">
          <th class="form__group-title">
            <span class="form__label--item">お問い合わせの種類</span>
            <span class="form__label--required">※</span>
          </th>
          <td class="form__group-content">
            <div class="form__select">
              <select class="create-form__item-select" name="category_id">
                <option value="">選択してください</option>
                @foreach ($categories as $category)
                  <option value="{{ $category['id'] }}"  {{ old('category_id') == $category['id'] ? 'selected' : '' }}>{{ $category['name'] }}</option>
                @endforeach
              </select>
            </div>
            <div class="form__error">
              @error('category_id')
              {{ $errors->first('category_id') }}
              @enderror
            </div>
          </td>
        </tr>
        <tr class="form__group">
          <th class="form__group-title">
            <span class="form__label--item">お問い合わせ内容</span>
            <span class="form__label--required">※</span>
          </th>
          <td class="form__group-content">
            <div class="form__input--textarea">
              <textarea name="detail" placeholder="資料をいただきたいです">{{ old('detail') }}</textarea>
            </div>
            <div class="form__error">
              @error('detail')
              {{ $errors->first('detail') }}
              @enderror
            </div>
          </td>
        </tr>
      </table>
      </div>
      <div class="form__button">
        <button class="form__button-submit" type="submit">送信</button>
      </div>
    </form>
  </div>
</div>
@endsection
