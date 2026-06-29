@extends('confirm.layout')

@section('title', 'تم التسجيل مسبقاً')

@section('content')
    <div class="ornament"></div>
    <h1 class="card-title">تم التسجيل مسبقاً</h1>

    @if ($name)
        <div class="guest-name">{{ $name }}</div>
    @endif

    <p class="message">لقد قمتم بالرد على هذه الدعوة مسبقاً</p>

    @if ($sessionTitle)
        <p class="subtitle">{{ $sessionTitle }}</p>
    @endif

    <div class="ornament ornament-bottom"></div>
@endsection
