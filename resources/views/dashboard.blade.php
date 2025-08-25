<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyApp Dashboard</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">MyApp Dashboard</h1>
            <div class="flex items-center space-x-4">
                <span class="hidden md:inline">Welcome, {{ $user->name }}</span>
                <div class="relative group">
                    <button class="flex items-center space-x-2 focus:outline-none">
                        <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" alt="Profile">
                        <span class="hidden md:inline"><i class="fas fa-chevron-down text-sm"></i></span>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 text-gray-800 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-10">
                        <a href="#" class="block px-4 py-2 hover:bg-blue-100"><i class="fas fa-user mr-2"></i> Profile</a>
                        <a href="#" class="block px-4 py-2 hover:bg-blue-100"><i class="fas fa-cog mr-2"></i> Settings</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-blue-100"><i class="fas fa-sign-out-alt mr-2"></i> Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-4 mt-4">
        <!-- Welcome Message -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Welcome, {{ $user->name }}!</h2>
            <p class="text-gray-600">You have successfully logged in with your Google account.</p>
        </div>

        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Calendar Card -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-calendar-alt text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="ml-4 text-xl font-semibold">Calendar</h3>
                </div>
                <p class="text-gray-600 mb-4">View and manage your upcoming events and appointments.</p>
                <a href="{{ route('calendar') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors inline-block">View Calendar</a>
            </div>

            <!-- Email Card -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center mb-4">
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-envelope text-green-600 text-xl"></i>
                    </div>
                    <h3 class="ml-4 text-xl font-semibold">Email</h3>
                </div>
                <p class="text-gray-600 mb-4">Check your latest emails and manage your inbox.</p>
                <a href="{{ route('email') }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors inline-block">Check Emails</a>
            </div>

            <!-- ToDos Card -->
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center mb-4">
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-tasks text-purple-600 text-xl"></i>
                    </div>
                    <h3 class="ml-4 text-xl font-semibold">ToDos</h3>
                </div>
                <p class="text-gray-600 mb-4">Manage your tasks and stay organized with your to-do list.</p>
                <a href="{{ route('todos') }}" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700 transition-colors inline-block">View Tasks</a>
            </div>
        </div>
    </div>

    <!-- Debug Info (remove in production) -->
    @if(env('APP_DEBUG'))
    <div class="container mx-auto p-4 mt-6 bg-gray-200 rounded-lg">
        <h3 class="font-bold">Debug Information:</h3>
        <p>User: {{ $user->name }} ({{ $user->email }})</p>
        <p>Logged in: {{ Auth::check() ? 'Yes' : 'No' }}</p>
        <p>Session ID: {{ session()->getId() }}</p>
    </div>
    @endif
</body>
</html>