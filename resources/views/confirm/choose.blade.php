@extends('confirm.layout')

@section('title', 'تأكيد الحضور')

@section('content')
    <h1>
        @if ($name)
            مرحباً {{ $name }}
        @else
            مرحباً
        @endif
    </h1>
    @if ($sessionTitle)
        <p class="subtitle">{{ $sessionTitle }}</p>
    @endif
    <p class="subtitle">يرجى اختيار أحد الخيارين:</p>

    <div class="actions">
        <form method="POST" action="{{ route('confirm.respond') }}">
            @csrf
            <input type="hidden" name="action" value="confirm">
            @if ($isDirect)
                <input type="hidden" name="phone" value="{{ $phone }}">
                <input type="hidden" name="name" value="{{ $name }}">
            @endif
            <button type="submit" class="btn btn-confirm">تأكيد الحضور</button>
        </form>

        <form method="POST" action="{{ route('confirm.respond') }}">
            @csrf
            <input type="hidden" name="action" value="decline">
            @if ($isDirect)
                <input type="hidden" name="phone" value="{{ $phone }}">
                <input type="hidden" name="name" value="{{ $name }}">
            @endif
            <button type="submit" class="btn btn-decline">الاعتذار عن الحضور</button>
        </form>
    </div>
@endsection
