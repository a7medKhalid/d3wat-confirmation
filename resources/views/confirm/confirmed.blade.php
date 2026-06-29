@extends('confirm.layout')

@section('title', 'تم تأكيد الحضور')

@section('content')
    <div class="ornament"></div>
    <h1 class="card-title">تم تأكيد الحضور</h1>

    @if ($name)
        <div class="guest-name">{{ $name }}</div>
    @endif

    <div class="panel panel-green">
        <p class="message">مرحباً بكم، حُللتم أهلاً ووطئتم سهلاً</p>
    </div>

    @if ($sessionTitle)
        <p class="subtitle">{{ $sessionTitle }}</p>
    @endif

    <div class="ornament ornament-bottom"></div>
@endsection
