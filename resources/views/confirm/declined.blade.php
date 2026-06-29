@extends('confirm.layout')

@section('title', 'تم الاعتذار')

@section('content')
    <div class="ornament"></div>
    <h1 class="card-title">الاعتذار</h1>

    @if ($name)
        <div class="guest-name">{{ $name }}</div>
    @endif

    <div class="panel">
        <p class="message-strong">تم التأكيد</p>
        <p class="message">طابت أوقاتكم وجمعنا الله بكم في المسرات</p>
    </div>

    @if ($sessionTitle)
        <p class="subtitle">{{ $sessionTitle }}</p>
    @endif

    <div class="ornament ornament-bottom"></div>
@endsection
