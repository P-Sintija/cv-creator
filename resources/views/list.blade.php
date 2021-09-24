@extends('layout')

@section('content')

<div class="bg-gray-100">
    @if(count($list) !== 0)
    <div class="overflow-x-auto">
        <div class="min-w-screen min-h-screen bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Vārds</th>
                                <th class="py-3 px-6 text-left">Uzvārds</th>
                                <th class="py-3 px-6 text-center">Tālrunis</th>
                                <th class="py-3 px-6 text-center">Epasts</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach ($list as $basicData)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{ $basicData->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{ $basicData->surname }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        <span class="font-medium">{{ $basicData->phone }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        <span class="font-medium">{{ $basicData->email }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <form method="get" action="{{ route('printPreview.show', ['id' => $basicData->id])}}">
                                            @csrf
                                            <button type="submit" name="id" value="{{ $basicData->id }}">
                                                <div class="w-4 mr-2 transform hover:text-green-600 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </form>
                                        <form method="get" action="{{ route('cv.show', ['id' => $basicData->id])}}">
                                            @csrf
                                            <button type="submit" name="id" value="{{ $basicData->id }}">
                                                <div class="w-4 mr-2 transform hover:text-green-600 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </form>
                                        <form method="post" action="{{ route('delete.destroy', ['id' => $basicData->id] )}}">
                                            @csrf
                                            <button type="submit">
                                                <div class="w-4 mr-2 transform hover:text-green-600 hover:scale-110">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </div>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="flex justify-center">
        <form class="flex justify-center w-full lg:w-5/6 mx-8 mb-8 mt-4 bg-green-500 px-6 py-2 rounded 
            hover:bg-green-600 transition duration-200 each-in-out shadow-md" method="get" action="{{ route('create.index') }}">
            @csrf
            <button class="font-medium text-white" type="submit">
                Izveidot jaunu CV
            </button>
        </form>
    </div>
</div>
@endsection