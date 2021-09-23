@extends('layout')

@section('content')

<div id="app">
    <create-form />
</div>

<form method="get" action="{{ route('home.index') }}">
    @csrf
    <button type="submit">
        Sākums
    </button>
</form>

@endsection