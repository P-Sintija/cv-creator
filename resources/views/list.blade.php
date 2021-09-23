@extends('layout')

@section('content')

@if(count($list) !== 0)
<table>
    <thead>
        <tr>
            <th>Vārds</th>
            <th>Uzvārds</th>
            <th>Telefons</th>
            <th>Epasts</th>
            <th>Type</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $basicData)
        <tr>
            <td>
                <div>
                    <span>
                        {{ $basicData->name }}
                    </span>
                </div>
            </td>
            <td>
                <div>
                    <span>
                        {{ $basicData->surname }}
                    </span>
                </div>
            </td>
            <td>
                <div>
                    <span>
                        {{ $basicData->phone }}
                    </span>
                </div>
            </td>
            <td>
                <div>
                    <span>
                        {{ $basicData->email }}
                    </span>
                </div>
            </td>
            <td>
                <div>
                    <form method="post" action="{{ route('delete.destroy', ['id' => $basicData->id] )}}">
                        @csrf
                        <button type="submit">
                            Delete
                        </button>
                    </form>
                    <form method="get" action="{{ route('cv.show', ['id' => $basicData->id])}}">
                        @csrf
                        <button type="submit" name="smth" value="{{ $basicData->id }}">
                            Edit
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif


<form method="get" action="{{ route('create.index') }}">
    @csrf
    <button type="submit">
        Create new CV
    </button>
</form>

@endsection