<!-- layout.blade.phpを継承 -->
@extends('layout')

<!-- @yeild('title')と@yeild('content')に挿入 -->
@section('title', 'カレンダー')
@section('content')
    <!-- CanlendarControllerから渡されてきた値 -->
    {!!$cal_tag!!}
@endsection
<a href="{{ url('/holiday') }}">休日設定</a>