<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight animate__animated animate__fadeInDown">
            {{ __('Lecturer Dashboard') }}
        </h2>
    </x-slot>

    <!-- Animate.css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <div class="bg-gradient-to-br from-black via-indigo-900 to-purple-900 min-h-screen p-6 lg:p-8 text-white">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">

            <!-- Sidebar -->
            <nav class="bg-black bg-opacity-50 shadow-2xl rounded-2xl p-6 flex flex-col h-fit lg:h-[calc(100vh-8rem)] animate__animated animate__fadeInLeft text-white">
                <ul class="space-y-3 flex-grow">
                    <li><a href="#" id="dashboard-link" class="block text-purple-300 hover:text-white font-medium py-2 px-3 rounded-md hover:bg-gradient-to-r from-purple-700 to-indigo-800 transition duration-300">Dashboard</a></li>
                    <li><a href="#" id="courses-link" class="block text-purple-300 hover:text-white font-medium py-2 px-3 rounded-md hover:bg-gradient-to-r from-purple-700 to-indigo-800 transition duration-300">Manage Courses</a></li>
                    <li><a href="#" id="students-link" class="block text-purple-300 hover:text-white font-medium py-2 px-3 rounded-md hover:bg-gradient-to-r from-purple-700 to-indigo-800 transition duration-300">Enrolled Students</a></li>
                    <li><a href="#" id="profile-link" class="block text-purple-300 hover:text-white font-medium py-2 px-3 rounded-md hover:bg-gradient-to-r from-purple-700 to-indigo-800 transition duration-300">Profile</a></li>
                    <li><a href="{{ route('lecturer.marks.create') }}" class="block px-4 py-2 text-purple-300 hover:underline">Enter Student Marks</a></li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mt-auto">
                    @csrf
                </form>
            </nav>

            <!-- Main Content -->
            <main class="lg:col-span-3 bg-black bg-opacity-40 rounded-2xl shadow-xl p-6 lg:p-8 animate__animated animate__fadeInUp">
                <header class="mb-8">
                    <h1 class="text-2xl font-bold text-white">Welcome, {{ Auth::user()->name }}!</h1>
                    <p class="text-sm text-purple-200 mt-1">Manage your courses and student records efficiently.</p>
                </header>

                <!-- Dashboard Cards -->
                <section class="cards-section" id="dashboard-cards">
                    <h2 class="text-lg font-semibold text-purple-300 mb-4">Overview</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-gradient-to-br from-green-700 to-green-500 border border-green-800 rounded-lg p-6 shadow-md hover:scale-105 transition-transform duration-300">
                            <h3 class="text-base font-semibold text-white mb-2">Courses Taught</h3>
                            <p class="text-3xl font-bold">{{ $courses->count() }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-yellow-600 to-pink-500 border border-yellow-800 rounded-lg p-6 shadow-md hover:scale-105 transition-transform duration-300">
                            <h3 class="text-base font-semibold text-white mb-2">Students Enrolled</h3>
                            <p class="text-3xl font-bold">{{ $courses->flatMap->students->unique('id')->count() }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-purple-700 to-red-600 border border-purple-800 rounded-lg p-6 shadow-md hover:scale-105 transition-transform duration-300">
                            <h3 class="text-base font-semibold text-white mb-2">Pending Assignments</h3>
                            <p class="text-3xl font-bold">0</p>
                        </div>
                    </div>
                </section>

                <!-- Enroll Students -->
                <section class="cards-section animate__animated animate__fadeIn" id="students-cards" style="display:none;">
                    <h2 class="text-lg font-semibold text-purple-300 mb-6">Enroll Student to Course</h2>
                    <div class="bg-black bg-opacity-50 border border-purple-700 rounded-lg p-6 shadow-sm max-w-xl">
                        <form action="{{ route('enroll') }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="student_id" class="block text-sm font-medium text-white mb-1">Select Student</label>
                                <select name="student_id" id="student_id" required class="block w-full rounded-md border-purple-600 bg-gray-800 text-white py-2">
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="course_id" class="block text-sm font-medium text-white mb-1">Select Course</label>
                                <select name="course_id" id="course_id" required class="block w-full rounded-md border-purple-600 bg-gray-800 text-white py-2">
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="w-full text-center py-2 px-6 bg-gradient-to-r from-green-500 to-blue-600 text-white font-semibold rounded-md hover:from-blue-700 hover:to-green-700 transition duration-300">
                                Enroll Student
                            </button>
                        </form>
                    </div>
                </section>

                <!-- Create Course -->
                <section class="cards-section animate__animated animate__fadeIn" id="courses-cards" style="display:none;">
                    <h2 class="text-lg font-semibold text-purple-300 mb-6">Create New Course</h2>
                    <div class="bg-black bg-opacity-50 border border-purple-700 rounded-lg p-6 shadow-sm max-w-3xl">
                        <form action="{{ route('lecturer.courses.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="title" class="block text-sm font-medium text-white mb-1">Course Title</label>
                                <input type="text" name="title" id="title" required class="block w-full rounded-md border-gray-700 bg-gray-800 text-white p-2 text-sm focus:border-purple-500 focus:ring-purple-500"/>
                            </div>
                            <div>
                                <label for="description" class="block text-sm font-medium text-white mb-1">Course Description</label>
                                <textarea name="description" id="description" rows="3" required class="block w-full rounded-md border-gray-700 bg-gray-800 text-white p-2 text-sm focus:border-purple-500 focus:ring-purple-500"></textarea>
                            </div>
                            <h3 class="text-base font-semibold text-purple-200 mb-4">Modules (max 10)</h3>
                            <div id="modules-container" class="space-y-4 max-h-[400px] overflow-y-auto border border-purple-600 rounded-md p-4 bg-gray-900">
                                @for ($i = 0; $i < 10; $i++)
                                    <div class="border-b border-gray-700 pb-4 last:border-b-0">
                                        <label for="modules[{{ $i }}][title]" class="block text-sm font-medium text-white mb-1">Module Title</label>
                                        <input type="text" name="modules[{{ $i }}][title]" id="modules[{{ $i }}][title]" class="block w-full rounded-md border-gray-700 bg-gray-800 text-white p-2 text-sm" />
                                        <label for="modules[{{ $i }}][description]" class="block text-sm font-medium text-white mt-3 mb-1">Module Description</label>
                                        <input type="text" name="modules[{{ $i }}][description]" id="modules[{{ $i }}][description]" class="block w-full rounded-md border-gray-700 bg-gray-800 text-white p-2 text-sm" />
                                    </div>
                                @endfor
                            </div>
                            <button type="submit" class="inline-flex justify-center py-2 px-6 text-white font-semibold rounded-md bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-purple-600 hover:to-indigo-600 transition duration-300">
                                Create Course
                            </button>
                        </form>
                    </div>
                </section>

                <!-- Profile Section -->
                <section class="cards-section animate__animated animate__fadeIn" id="profile-cards" style="display:none;">
                    <h2 class="text-lg font-semibold text-purple-300 mb-4">Profile</h2>
                    <div class="bg-black bg-opacity-50 border border-purple-700 rounded-lg p-6 shadow-sm">
                        <p class="text-sm text-purple-200">Profile management coming soon.</p>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <script>
        const links = {
            'dashboard-link': 'dashboard-cards',
            'courses-link': 'courses-cards',
            'students-link': 'students-cards',
            'profile-link': 'profile-cards'
        };

        Object.keys(links).forEach(linkId => {
            document.getElementById(linkId).addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.cards-section').forEach(section => {
                    section.style.display = 'none';
                });
                document.getElementById(links[linkId]).style.display = 'block';
            });
        });
    </script>
</x-app-layout>
