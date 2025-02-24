@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-gray-800 rounded-xl text-white">
    <h2 class="text-3xl font-semibold text-center mb-6">Add Team</h2>

    <form action="{{ route('store.team') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block text-lg">Match</label>
            <input type="text" name="match" required class="w-full px-4 py-2 rounded-md bg-gray-700 border border-gray-600 focus:border-blue-400 focus:outline-none">
        </div>

        <div>
            <label class="block text-lg">Price</label>
            <input type="number" name="price" required class="w-full px-4 py-2 rounded-md bg-gray-700 border border-gray-600 focus:border-blue-400 focus:outline-none">
        </div>


        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">Save Team</button>
    </form>
</div>
@endsection
