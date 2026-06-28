@extends('confirm.layout')

@section('title', 'تم التأكيد')

@section('content')
    <div class="icon icon-success">✓</div>
    <h1>
        @if ($name)
            شكراً {{ $name }}، تم تأكيد حضوركم
        @else
            شكراً، تم تأكيد حضوركم
        @endif
    </h1>
    @if ($sessionTitle)
        <p class="subtitle">{{ $sessionTitle }}</p>
    @endif
@endsection
