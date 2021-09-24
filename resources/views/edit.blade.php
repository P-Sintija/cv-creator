@extends('layout')

@section('content')

<div id="app">
    <edit-form :user-basic-data="{{ $basicData }}" :user-address="{{ $address }}" :user-education="{{ $education }}" :user-employment="{{ $employment }}" :user-employment-description="{{ $employmentDescription }}" :user-language="{{ $language }}">
    </edit-form>
</div>
<form class="flex justify-center mx-8 mt-4 bg-green-500 px-6 py-2 rounded shadow-md
        hover:bg-green-600 transition duration-200 each-in-out" method="get" action="{{ route('printPreview.show', ['id' => $basicData->id])}}">
    @csrf
    <button class="text-white font-medium" type="submit" name="smth" value="{{ $basicData->id }}">
        Print Preview
    </button>
</form>
<form class="flex justify-center mx-8 mb-8 mt-4 bg-green-500 px-6 py-2 rounded shadow-md
        hover:bg-green-600 transition duration-200 each-in-out" method="get" action="{{ route('home.index') }}">
    @csrf
    <button class="text-white font-medium" type="submit">
        Sākums
    </button>
</form>

@endsection