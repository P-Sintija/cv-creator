@extends('layout')

@section('content')
<div class="flex flex-col">
    <div class="mx-8 mt-8" id="app">
        <create-form />
    </div>
    <form class="flex justify-center mx-8 mb-8 mt-4 bg-green-500 px-6 py-2 rounded shadow-md
        hover:bg-green-600 transition duration-200 each-in-out" method="get" action="{{ route('home.index') }}">
        @csrf
        <button class="text-white font-medium" type="submit">
            Uz sākumu
        </button>
    </form>
</div>
@endsection