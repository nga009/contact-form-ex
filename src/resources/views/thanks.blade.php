@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
    <div class="thanks__content">
      <h2>お問い合わせありがとうございました</h2>
        <div class="a__button">
          <a class="a__button--home" href="/">HOME</a>
        </div>
    </div>
@endsection
