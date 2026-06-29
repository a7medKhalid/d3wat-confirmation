@extends('confirm.layout')

@section('title', 'رابط غير صالح')

@section('content')
    <div class="ornament"></div>
    <h1 class="card-title">تعذر المتابعة</h1>
    <p class="message">{{ $message }}</p>
    <div class="ornament ornament-bottom"></div>
@endsection
