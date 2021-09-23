@extends('layout')

@section('content')

<h3>Pamatdati</h3>
<p>Vārds: </p><span> {{ $basicData->name }}</span>
<p>Uzvārds: </p><span> {{ $basicData->surname }}</span>
@if (strlen($basicData->phone) > 0)
<p>Tālrunis: </p><span> {{ $basicData->phone }}</span>
@endif
<p>Epasts: </p><span> {{ $basicData->email }}</span>

<h3>Adrese</h3>
<h3>Izglītība</h3>
<h3>Darba pieredze</h3>


<form method="get" action="{{ route('home.index') }}">
    @csrf
    <button type="submit">
        Sākums
    </button>
</form>

@endsection