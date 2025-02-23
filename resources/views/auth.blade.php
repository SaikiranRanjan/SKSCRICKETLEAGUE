<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-800 flex items-center justify-center h-screen">
    <div class="w-full max-w-md p-6 bg-white/10 backdrop-blur-md rounded-xl shadow-lg text-white">
        <h2 class="text-3xl font-semibold text-center mb-6">Welcome</h2>
        
        <div class="flex justify-center mb-4">
            <button id="loginBtn" class="px-4 py-2 mx-2 bg-blue-500 rounded-md text-white hover:bg-blue-600">Login</button>
            <button id="registerBtn" class="px-4 py-2 mx-2 bg-gray-600 rounded-md text-white hover:bg-gray-700">Register</button>
        </div>
        

        <!-- Login Form -->
        <form id="loginForm" class="space-y-4" action="{{ route('login') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email" required class="w-full px-4 py-2 rounded-md bg-gray-700 border border-gray-600 focus:border-blue-400 focus:outline-none">
            <input type="password" name="password" placeholder="Password" required class="w-full px-4 py-2 rounded-md bg-gray-700 border border-gray-600 focus:border-blue-400 focus:outline-none">
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Login</button>
        </form>

        <!-- Register Form (Initially Hidden) -->

        <form id="registerForm" class="space-y-4 hidden" action="{{ route('register') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Full Name" required class="w-full px-4 py-2 rounded-md bg-gray-700 border border-gray-600 focus:border-green-400 focus:outline-none">
            <input type="email" name="email" placeholder="Email" required class="w-full px-4 py-2 rounded-md bg-gray-700 border border-gray-600 focus:border-green-400 focus:outline-none">
            <input type="password" name="password" placeholder="Password" required class="w-full px-4 py-2 rounded-md bg-gray-700 border border-gray-600 focus:border-green-400 focus:outline-none">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="w-full px-4 py-2 rounded-md bg-gray-700 border border-gray-600 focus:border-green-400 focus:outline-none">
            <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">Register</button>
        </form>
    </div>
    
    <script>
        document.getElementById('loginBtn').addEventListener('click', function() {
            document.getElementById('loginForm').classList.remove('hidden');
            document.getElementById('registerForm').classList.add('hidden');
        });
        document.getElementById('registerBtn').addEventListener('click', function() {
            document.getElementById('registerForm').classList.remove('hidden');
            document.getElementById('loginForm').classList.add('hidden');
        });
    </script>
</body>
</html>
