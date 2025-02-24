@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-gray-800 rounded-xl text-white">
    <h2 class="text-3xl font-semibold text-center mb-6">Manage Teams</h2>

    @if(session('success'))
        <p class="bg-green-500 text-white p-2 text-center">{{ session('success') }}</p>
    @endif

    <table class="w-full border border-gray-700 text-white text-center">
        <thead>
            <tr class="bg-gray-700">
                <th class="p-2">ID</th>
                <th class="p-2">Match</th>
                <th class="p-2">Price</th>
                <th class="p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teams as $team)
            <tr class="border-b border-gray-600">
                <td class="p-2">{{ $team->id }}</td>
                <td class="p-2">{{ $team->match }}</td>
                <td class="p-2">${{ $team->price }}</td>
                <td class="p-2">
                    <a href="{{ route('edit.team', $team->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded">Edit</a>
                    <form action="{{ route('delete.team', $team->id) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
