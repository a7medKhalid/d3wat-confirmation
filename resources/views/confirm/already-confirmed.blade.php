@extends('confirm.layout')

@section('title', 'تم التأكيد مسبقاً')

@section('content')
    <div class="icon icon-info">!</div>
    <h1>تم تأكيد حضوركم مسبقاً</h1>
    @if ($name)
        <p class="subtitle">{{ $name }}</p>
    @elseif ($sessionTitle)
        <p class="subtitle">{{ $sessionTitle }}</p>
    @endif
@endsection
