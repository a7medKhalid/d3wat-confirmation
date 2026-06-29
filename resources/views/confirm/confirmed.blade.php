@extends('confirm.layout')

@section('title', 'تم التأكيد')

@section('content')
    <div class="ornament"></div>
    <h1 class="card-title">تم التأكيد</h1>

    @if ($name)
        <div class="guest-name">{{ $name }}</div>
    @endif

    <div class="panel">
        <p class="message-strong">تم التأكيد..</p>
        <p class="message">مرحباً بكم، حُللتم أهلاً ووطئتم سهلاً</p>
    </div>

    @if ($sessionTitle)
        <p class="subtitle">{{ $sessionTitle }}</p>
    @endif

    <div class="ornament ornament-bottom"></div>
@endsection
