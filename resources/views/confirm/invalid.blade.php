@extends('confirm.layout')

@section('title', 'رابط غير صالح')

@section('content')
    <div class="icon icon-error">✕</div>
    <h1>تعذر تأكيد الحضور</h1>
    <p class="subtitle">{{ $message }}</p>
@endsection
