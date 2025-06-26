<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome to UniPortal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tailwind CDN for convenience -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: radial-gradient(ellipse at bottom, #1b2735 0%, #090a0f 100%);
            overflow: hidden;
            color: white;
        }

        /* Starfield animation layers */
        .stars,
        .stars2,
        .stars3 {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background: transparent url('https://raw.githubusercontent.com/VincentGarreau/particles.js/master/demo/media/star.png') repeat;
            animation: moveStars 200s linear infinite;
            z-index: 0;
        }

        .stars2 {
            background-size: 1px;
            opacity: 0.5;
            animation-duration: 300s;
        }

        .stars3 {
            background-size: 2px;
            opacity: 0.3;
            animation-duration: 400s;
        }

        @keyframes moveStars {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(-1000px);
            }
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

        /* Planet animations */
        @keyframes spinSlow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes floatSlow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-spin-slow {
            animation: spinSlow 60s linear infinite;
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-float-slow {
            animation: floatSlow 10s ease-in-out infinite;
        }
    </style>
</head>

<body class="relative min-h-screen flex items-center justify-center px-6">


    <!-- Starfield Layers -->
    <div class="stars"></div>
    <div class="stars2"></div>
    <div class="stars3"></div>

    <!-- Animated Planets -->
    <div class="absolute top-10 left-10 animate-spin-slow w-16 h-16 z-0 opacity-50">
        <img src="{{ asset('images/planet1.svg') }}" alt="Planet 1" class="w-full h-full">
    </div>

    <div class="absolute bottom-20 right-20 animate-float-slow w-20 h-20 z-0 opacity-60">
        <img src="{{ asset('images/planet2.svg') }}" alt="Planet 2" class="w-full h-full">
    </div>

    <div class="absolute top-1/3 right-1/4 animate-float w-12 h-12 z-0 opacity-40">
        <img src="{{ asset('images/moon.svg') }}" alt="Moon" class="w-full h-full">
    </div>

    <!-- Main Content -->
    <div class="w-full max-w-5xl bg-white/10 backdrop-blur-md shadow-2xl rounded-2xl overflow-hidden z-10 text-white">

        <!-- Hero Section -->
        <section class="text-center px-10 py-14 animate-fade-up">
            <div class="flex justify-center mb-6">
                <img src="{{ asset('images/my-logo.png') }}" alt="Logo" class="max-h-20 max-w-[250px]" />
            </div>

            <h1 class="text-5xl font-bold text-indigo-300 mb-4 tracking-tight drop-shadow-md"> Welcome to <span class="text-indigo-500">UniPortal</span></h1>
            <p class="text-lg text-indigo-100 max-w-2xl mx-auto mb-6">
                Embark on your academic journey — explore knowledge like stars in the universe.
            </p>
            <div class="flex justify-center gap-4 mt-6 flex-wrap">
                <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md font-semibold shadow-md transition-all duration-300">
                    Login
                </a>
                <a href="{{ route('register') }}" class="bg-transparent border border-indigo-400 text-indigo-200 px-6 py-2 rounded-md font-semibold hover:bg-indigo-600 transition-all duration-300">
                    Register
                </a>
            </div>
        </section>

        <!-- Features Section -->
        <section class="grid grid-cols-1 sm:grid-cols-3 gap-8 px-10 py-12 animate-fade-up">
            <div class="text-center hover:scale-105 transition-transform duration-300">
                <div class="text-4xl mb-3">📘</div>
                <h3 class="text-xl font-bold text-indigo-300">Courses</h3>
                <p class="text-sm text-indigo-100 mt-2">Access stellar course content and resources.</p>
            </div>
            <div class="text-center hover:scale-105 transition-transform duration-300 delay-100">
                <div class="text-4xl mb-3">👩‍🏫</div>
                <h3 class="text-xl font-bold text-indigo-300">Lecturers</h3>
                <p class="text-sm text-indigo-100 mt-2">Connect with academic guides of your cosmic journey.</p>
            </div>
            <div class="text-center hover:scale-105 transition-transform duration-300 delay-200">
                <div class="text-4xl mb-3">📈</div>
                <h3 class="text-xl font-bold text-indigo-300">Progress</h3>
                <p class="text-sm text-indigo-100 mt-2">Track your achievements across the universe of knowledge.</p>
            </div>
        </section>

        <!-- Footer -->
        <footer class="text-center text-indigo-200 text-sm py-4 border-t border-indigo-600 bg-indigo-900/20 animate-fade-up">
            &copy; {{ date('Y') }} UniPortal. Explore. Discover. Achieve.
        </footer>

    </div>

</body>

</html>