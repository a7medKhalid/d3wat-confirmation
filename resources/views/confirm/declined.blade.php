@extends('confirm.layout')

@section('title', 'تم الاعتذار')

@section('content')
    <div class="icon icon-info">!</div>
    <h1>
        @if ($name)
            شكراً {{ $name }}، تم تسجيل اعتذاركم
        @else
            شكراً، تم تسجيل اعتذاركم
        @endif
    </h1>
    @if ($sessionTitle)
        <p class="subtitle">{{ $sessionTitle }}</p>
    @endif
@endsection
