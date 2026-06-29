@extends('confirm.layout')

@section('title', 'تم تأكيد الإعتذار')

@section('content')
    <div class="ornament"></div>
    <h1 class="card-title">تم تأكيد الإعتذار</h1>

    @if ($name)
        <div class="guest-name">{{ $name }}</div>
    @endif

    <div class="panel panel-yellow">
        <p class="message">طابت أوقاتكم وجمعنا الله بكم في المسرات</p>
    </div>

    @if ($sessionTitle)
        <p class="subtitle">{{ $sessionTitle }}</p>
    @endif

    <div class="ornament ornament-bottom"></div>
@endsection
