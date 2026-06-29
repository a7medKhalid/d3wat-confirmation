@extends('confirm.layout')

@section('title', 'تم التسجيل مسبقاً')

@section('content')
    <div class="icon icon-info">!</div>
    <h1>تم تسجيل ردكم مسبقاً</h1>
    @if ($name)
        <p class="subtitle">{{ $name }}</p>
    @elseif ($sessionTitle)
        <p class="subtitle">{{ $sessionTitle }}</p>
    @endif
@endsection
