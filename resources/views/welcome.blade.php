<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-teal-700 via-sky-900 to-purple-900 min-h-screen flex items-center justify-center font-sans">
    <div class="bg-gray-800/90 backdrop-blur-lg p-8 rounded-3xl shadow-2xl w-full max-w-md text-left transition-transform hover:scale-105 hover:shadow-cyan-500/20">
        
        <!-- Logo / Title -->
        <div class="flex items-center justify-center mb-6">
            <span class="text-cyan-400 text-2xl font-extrabold">✨ My Laravel</span>
        </div>

        <h2 class="text-2xl font-extrabold text-cyan-300 text-center mb-2">Hello Again</h2>
        <p class="text-gray-400 text-center mb-6">Login to explore the dashboard</p>

        <!-- Alerts -->
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

        <!-- Form -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <!-- Email -->
            <label class="block text-gray-300 mb-2">Email Address</label>
            <input type="email" name="email" placeholder="you@example.com"
                   class="w-full px-4 py-2 mb-4 rounded-xl bg-gray-900 border border-gray-700 text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cyan-400 shadow-md">

            <!-- Password -->
            <label class="block text-gray-300 mb-2">Password</label>
            <input type="password" name="password" placeholder="••••••••"
                   class="w-full px-4 py-2 mb-4 rounded-xl bg-gray-900 border border-gray-700 text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-cyan-400 shadow-md">

            <!-- Options -->
            <div class="flex items-center justify-between text-sm mb-6">
                <label class="flex items-center text-gray-400">
                    <input type="checkbox" name="remember" class="mr-2 accent-cyan-400"> Remember me
                </label>
                <a href="#" class="text-cyan-400 hover:underline">Forgot password?</a>
            </div>

            <!-- Login Button -->
            <button type="submit" class="w-full flex justify-center items-center bg-gradient-to-r from-cyan-500 to-blue-600 text-white py-2.5 rounded-xl font-semibold hover:opacity-90 transition shadow-lg">
                🔑 Sign In
            </button>
        </form>

        <!-- Divider -->
        <div class="flex items-center my-6">
            <hr class="flex-grow border-gray-600">
            <span class="mx-2 text-gray-400 text-sm">or</span>
            <hr class="flex-grow border-gray-600">
        </div>

        <!-- Google Login -->
        <!-- Google Login -->
        <a href="{{ route('google.redirect') }}"
        class="w-full flex items-center justify-center bg-gray-700 py-2.5 rounded-xl text-gray-200 hover:bg-gray-600 transition shadow-md">
            <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5 mr-2"> Continue with Google
        </a>

        <!-- Footer -->
        <p class="text-center text-gray-400 text-sm mt-6">
            New here?
            <a href="#" class="text-cyan-400 hover:underline">Create an account</a>
        </p>
    </div>
</body>
</html>
