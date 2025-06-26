<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome to UniPortal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tailwind Animate.css plugin via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        @keyframes fadeUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-up {
            animation: fadeUp 0.8s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-white text-gray-800 min-h-screen flex items-center justify-center px-6">

    <div class="w-full max-w-5xl bg-white shadow-2xl rounded-2xl overflow-hidden">

        <!-- Hero Section -->
        <section class="text-center px-10 py-14 bg-blue-50 animate-fade-up">
            <h1 class="text-5xl font-bold text-blue-900 mb-4 tracking-tight">🎓 Welcome to <span class="text-blue-600">UniPortal</span></h1>
            <p class="text-lg text-gray-700 max-w-2xl mx-auto mb-6">
                Kickstart your academic experience — manage courses, connect with faculty, and track your progress.
            </p>
            <div class="flex justify-center gap-4 mt-6 flex-wrap">
                <a href="{{ route('login') }}" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-2 rounded-md font-semibold shadow-md transition-all duration-300">
                    Login
                </a>
                <a href="{{ route('register') }}" class="bg-white border border-blue-600 text-blue-700 px-6 py-2 rounded-md font-semibold hover:bg-blue-100 transition-all duration-300">
                    Register
                </a>
            </div>
        </section>

        <!-- Features Section -->
        <section class="grid grid-cols-1 sm:grid-cols-3 gap-8 px-10 py-12 bg-white animate-fade-up">
            <div class="text-center hover:scale-105 transition-transform duration-300">
                <div class="text-4xl mb-3">📘</div>
                <h3 class="text-xl font-bold text-blue-800">Courses</h3>
                <p class="text-sm text-gray-600 mt-2">Access learning materials, modules, and schedules tailored to your studies.</p>
            </div>
            <div class="text-center hover:scale-105 transition-transform duration-300 delay-100">
                <div class="text-4xl mb-3">👩‍🏫</div>
                <h3 class="text-xl font-bold text-blue-800">Lecturers</h3>
                <p class="text-sm text-gray-600 mt-2">Collaborate with academic staff and receive timely feedback.</p>
            </div>
            <div class="text-center hover:scale-105 transition-transform duration-300 delay-200">
                <div class="text-4xl mb-3">📈</div>
                <h3 class="text-xl font-bold text-blue-800">Progress</h3>
                <p class="text-sm text-gray-600 mt-2">Monitor your grades, assignments, and learning journey in real-time.</p>
            </div>
        </section>

        <!-- Footer -->
        <footer class="text-center text-gray-500 text-sm py-4 bg-blue-50 border-t animate-fade-up">
            &copy; {{ date('Y') }} UniPortal. All rights reserved.
        </footer>

    </div>

</body>
</html>
