<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lecturer Dashboard') }}
        </h2>
    </x-slot>

    <div class="bg-gray-50 min-h-screen p-6 lg:p-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
            <!-- Sidebar -->
            <nav class="bg-white shadow-lg rounded-xl p-6 flex flex-col h-fit lg:h-[calc(100vh-8rem)]">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <span>📗</span> Lecturer Portal
                </h3>
                <p class="text-sm text-gray-500 mb-6">
                    Logged in as: <span class="font-semibold text-gray-700">{{ Auth::user()->name }}</span>
                </p>
                <ul class="space-y-3 flex-grow">
                    <li>
                        <a href="#" id="dashboard-link" class="block text-blue-600 hover:text-blue-700 font-medium py-2 px-3 rounded-md hover:bg-blue-50 transition duration-150">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" id="courses-link" class="block text-blue-600 hover:text-blue-700 font-medium py-2 px-3 rounded-md hover:bg-blue-50 transition duration-150">
                            Manage Courses
                        </a>
                    </li>
                    <li>
                        <a href="#" id="students-link" class="block text-blue-600 hover:text-blue-700 font-medium py-2 px-3 rounded-md hover:bg-blue-50 transition duration-150">
                            Enrolled Students
                        </a>
                    </li>
                    <li>
                        <a href="#" id="profile-link" class="block text-blue-600 hover:text-blue-700 font-medium py-2 px-3 rounded-md hover:bg-blue-50 transition duration-150">
                            Profile
                        </a>
                    </li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mt-auto">
                    @csrf
                    <button type="submit" class="w-full text-left text-white font-semibold py-2 px-3 rounded-md bg-blue-600 hover:bg-blue-700 transition duration-150">
                        Logout
                    </button>
                </form>
            </nav>

            <!-- Main Content -->
            <main class="lg:col-span-3 bg-white rounded-xl shadow-lg p-6 lg:p-8">
                <header class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-800">Welcome, {{ Auth::user()->name }}!</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage your courses and student records efficiently.</p>
                </header>

                <!-- Dashboard Cards -->
                <section class="cards-section active" id="dashboard-cards">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Overview</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
                        <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition duration-200">
                            <h3 class="text-base font-semibold text-gray-700 mb-2">Courses Taught</h3>
                            <p class="text-3xl font-bold text-green-600">{{ $courses->count() }}</p>
                        </div>
                        <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition duration-200">
                            <h3 class="text-base font-semibold text-gray-700 mb-2">Students Enrolled</h3>
                            <p class="text-3xl font-bold text-green-600">{{ $courses->flatMap->students->unique('id')->count() }}</p>
                        </div>
                        <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition duration-200">
                            <h3 class="text-base font-semibold text-gray-700 mb-2">Pending Assignments</h3>
                            <p class="text-3xl font-bold text-green-600">0</p>
                        </div>
                    </div>
                </section>

                <!-- Enrollment Form -->
                <section class="cards-section" id="students-cards" style="display:none;">
                    <h2 class="text-lg font-semibold text-gray-700 mb-6">Enroll Student to Course</h2>
                    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm max-w-xl">
                        <form action="{{ route('enroll') }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="student_id" class="block text-sm font-medium text-gray-700 mb-1">Select Student</label>
                                <select name="student_id" id="student_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-2">
                                    @foreach ($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="course_id" class="block text-sm font-medium text-gray-700 mb-1">Select Course</label>
                                <select name="course_id" id="course_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm py-2">
                                    @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 rounded-md transition duration-150">
                                Enroll Student
                            </button>
                        </form>
                    </div>
                </section>

                <!-- Create Course Form -->
                <section class="cards-section" id="courses-cards" style="display:none;">
                    <h2 class="text-lg font-semibold text-gray-700 mb-6">Create New Course</h2>
                    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm max-w-3xl">
                        <form action="{{ route('lecturer.courses.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Course Title</label>
                                <input type="text" name="title" id="title" required
                                    class="block w-full rounded-md border border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 text-sm" />
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Course Description</label>
                                <textarea name="description" id="description" rows="3" required
                                    class="block w-full rounded-md border border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 text-sm"></textarea>
                            </div>

                            <h3 class="text-base font-semibold text-gray-700 mb-4">Modules (max 10)</h3>
                            <div id="modules-container" class="space-y-4 max-h-[400px] overflow-y-auto border border-gray-200 rounded-md p-4 bg-gray-50">
                                @for ($i = 0; $i < 10; $i++)
                                    <div class="border-b border-gray-200 pb-4 last:border-b-0 last:pb-0">
                                        <label for="modules[{{ $i }}][title]" class="block text-sm font-medium text-gray-700 mb-1">Module Title</label>
                                        <input type="text" name="modules[{{ $i }}][title]" id="modules[{{ $i }}][title]"
                                            class="block w-full rounded-md border border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 text-sm" />

                                        <label for="modules[{{ $i }}][description]" class="block text-sm font-medium text-gray-700 mt-3 mb-1">Module Description</label>
                                        <input type="text" name="modules[{{ $i }}][description]" id="modules[{{ $i }}][description]"
                                            class="block w-full rounded-md border border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 p-2 text-sm" />
                                    </div>
                                @endfor
                            </div>

                            <button
  type="submit"
  class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-semibold text-white rounded-md transition duration-150"
  style="background-color: #2563eb; /* Tailwind bg-blue-600 */"
  onmouseover="this.style.backgroundColor='#1e40af'" onmouseout="this.style.backgroundColor='#2563eb'">
  Create Course
</button>
                        </form>
                    </div>
                </section>

                <!-- Profile Section -->
                <section class="cards-section" id="profile-cards" style="display:none;">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Profile</h2>
                    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                        <p class="text-sm text-gray-600">Profile management coming soon.</p>
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