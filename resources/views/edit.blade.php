@extends('layout')

@section('content')

<div id="app">
    <edit-form :user-basic-data="{{ $basicData }}" :user-address="{{ $address }}" :user-education="{{ $education }}" :user-employment="{{ $employment }}" :user-employment-description="{{ $employmentDescription }}">
    </edit-form>
</div>


<form method="get" action="{{ route('printPreview.show', ['id' => $basicData->id])}}">
    @csrf
    <button type="submit" name="smth" value="{{ $basicData->id }}">
        Print Preview
    </button>
</form>

<form method="get" action="{{ route('home.index') }}">
    @csrf
    <button type="submit">
        Sākums
    </button>
</form>


@endsection