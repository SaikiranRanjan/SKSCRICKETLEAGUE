@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Manage Team Requests</h2>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">#</th>
                <th class="border p-2">User ID</th>
                <th class="border p-2">Requested Team ID</th>
                <th class="border p-2">Whatsapp Number</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teamRequests as $index => $request)
            <tr class="text-center">
                <td class="border p-2">{{ $index + 1 }}</td>
                <td class="border p-2">{{ $request->id }}</td>
                <td class="border p-2">{{ $request->requested_team_id  }}</td>
                <td class="border p-2">
                    <a href="https://wa.me/{{ $request->users_whatsapp_number }}" target="_blank" class="text-blue-500 underline">
                        {{ $request->users_whatsapp_number }}
                    </a>
                </td>

                <td class="border p-2">
                    <a href="#" class="bg-blue-500 text-white px-3 py-1 rounded">View</a>
                    <a href="#" class="bg-red-500 text-white px-3 py-1 rounded">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
