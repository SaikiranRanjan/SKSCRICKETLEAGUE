<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 text-white flex justify-between">
        <a href="{{ route('dashboard') }}" class="text-xl font-bold">Admin Panel</a>
        <div>
            <a href="{{ route('dashboard') }}" class="px-4 hover:underline">Dashboard</a>
            <a href="{{ route('add.team') }}" class="px-4 hover:underline">Add Team</a>
            <a href="{{ route('manage.team') }}" class="px-4 hover:underline">Manage Team</a>
            <a href="{{route('team.requested')}}" class="px-4 hover:underline">Team Requested By</a>
            <a href="{{ route('logout') }}" class="px-4 hover:underline" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="p-6">
        @yield('content')
    </div>

</body>
</html>
