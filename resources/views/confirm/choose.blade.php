@extends('confirm.layout')

@section('title', 'تأكيد الحضور')

@section('content')
    <div class="ornament"></div>
    <h1 class="card-title">بطاقة الدخول</h1>

    @if ($name)
        <div class="guest-name">{{ $name }}</div>
    @endif

    @if ($sessionTitle)
        <p class="subtitle">{{ $sessionTitle }}</p>
    @endif

    <p class="message">يرجى اختيار أحد الخيارين</p>

    <div class="actions">
        <form class="btn-form" method="POST" action="{{ route('confirm.respond') }}">
            @csrf
            <input type="hidden" name="action" value="confirm">
            @if ($isDirect)
                <input type="hidden" name="phone" value="{{ $phone }}">
                <input type="hidden" name="name" value="{{ $name }}">
            @endif
            <button type="submit" class="btn btn-confirm">تأكيد الحضور</button>
        </form>

        <form class="btn-form" method="POST" action="{{ route('confirm.respond') }}">
            @csrf
            <input type="hidden" name="action" value="decline">
            @if ($isDirect)
                <input type="hidden" name="phone" value="{{ $phone }}">
                <input type="hidden" name="name" value="{{ $name }}">
            @endif
            <button type="submit" class="btn btn-decline">الاعتذار عن الحضور</button>
        </form>
    </div>

    <div class="ornament ornament-bottom"></div>
@endsection
