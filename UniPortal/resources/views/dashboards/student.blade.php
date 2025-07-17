<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 600; font-size: 1.25rem; color: #1f2937; line-height: 1.5;">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div style="font-family: sans-serif; margin: 0; padding: 0; background: #f3f4f6;">
        <header style="background-color: #1d4ed8; color: white; padding: 1rem; display: flex; justify-content: space-between; align-items: center;">
            <div style="font-size: 1.5rem; font-weight: bold;">📘 Student Portal</div>
            <div>Logged in as: {{ Auth::user()->name }}</div>
        </header>

        <div style="display: flex; padding: 1rem;">
            <aside style="width: 200px; background: white; padding: 1rem; border-right: 1px solid #ccc;">
                <nav>
                    <a href="#" id="dashboard-link" style="display: block; margin-bottom: 0.5rem; color: #1d4ed8; text-decoration: none; font-weight: 500;">Dashboard</a>
                    <a href="#" id="courses-link" style="display: block; margin-bottom: 0.5rem; color: #1d4ed8; text-decoration: none; font-weight: 500;">My Courses</a>
                    <a href="#" id="grades-link" style="display: block; margin-bottom: 0.5rem; color: #1d4ed8; text-decoration: none; font-weight: 500;">Grades</a>
                    <a href="#" id="profile-link" style="display: block; margin-bottom: 0.5rem; color: #1d4ed8; text-decoration: none; font-weight: 500;">Profile</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="display: block; color: red; font-weight: 500;">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                </nav>
            </aside>

            <main style="flex: 1; padding: 1rem; background: white; margin-left: 1rem; border-radius: 0.5rem; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
                <h1 style="font-size: 1.5rem; font-weight: bold;">Welcome, {{ Auth::user()->name }}</h1>
                <p style="color: #4b5563;">Here are your enrolled courses and academic status.</p>

                <!-- Dashboard Cards -->
                <div class="cards-section" id="dashboard-cards" style="display: flex; flex-wrap: wrap; gap: 1rem; margin-top: 1rem;">
                    <div style="background: #e0f2fe; padding: 1rem; border-radius: 0.5rem; flex: 1 1 200px; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">Total Courses</h3>
                        <p>{{ $courses->count() }}</p>
                    </div>
                    <div style="background: #e0f2fe; padding: 1rem; border-radius: 0.5rem; flex: 1 1 200px; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">Average Grade</h3>
                        <p>75%</p> <!-- Replace with dynamic data if available -->
                    </div>
                    <div style="background: #e0f2fe; padding: 1rem; border-radius: 0.5rem; flex: 1 1 200px; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">Upcoming Exams</h3>
                        <p>none</p> <!-- Replace with dynamic data if available -->
                    </div>
                    <div style="background: #e0e7ff; padding: 1rem; border-radius: 0.5rem; flex: 1 1 200px; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">Enroll in Courses</h3>
                        <button id="enroll-button" style="background: #1d4ed8; color: white; border: none; padding: 0.5rem 1rem; border-radius: 0.25rem; font-weight: 500; cursor: pointer;">Browse Courses</button>
                    </div>
                </div>

                <!-- Course Enrollment Modal -->
                <div id="enroll-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center;">
                    <div style="background: white; padding: 2rem; border-radius: 0.5rem; width: 90%; max-width: 500px; max-height: 80%; overflow-y: auto; position: relative;">
                        <button id="close-modal" style="position: absolute; top: 1rem; right: 1rem; background: none; border: none; font-size: 1.5rem; cursor: pointer;">×</button>
                        <h2 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 1rem;">Available Courses</h2>
                        @if ($availableCourses->isEmpty())
                        <p>No courses available for enrollment.</p>
                        @else
                        <ul style="margin: 0; padding-left: 1.5rem;">
                            @foreach ($availableCourses as $course)
                            <li style="margin-bottom: 1rem;">
                                <strong>{{ $course->title }}</strong>
                                <form method="POST" action="{{ route('courses.enroll', $course->id) }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" style="margin-left: 1rem; background: #1d4ed8; color: white; border: none; padding: 0.5rem 1rem; border-radius: 0.25rem; font-weight: 500; cursor: pointer;">
                                        Enroll
                                    </button>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>

                <!-- My Courses -->
                <div class="cards-section" id="courses-cards" style="display: none; flex-direction: column; gap: 1rem; margin-top: 1rem;">
                    <div style="background: #fff3cd; padding: 1rem; border-radius: 0.5rem; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">Current Courses</h3>
                        @if ($courses->isEmpty())
                        <p>No courses enrolled.</p>
                        @else
                        <ul style="margin: 0; padding-left: 1.5rem;">
                            @foreach ($courses as $course)
                            <li>
                                <strong>{{ $course->title }}</strong><br>
                                <small style="color: #4b5563;">{{ $course->description }}</small>
                                @if ($course->modules && $course->modules->count())
                                <ul style="padding-left: 1rem; margin-top: 0.5rem;">
                                    @foreach ($course->modules as $module)
                                    <li>{{ $module->title }} - <small>{{ $module->description }}</small></li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>


                <!-- Grades -->
                <div class="cards-section" id="grades-cards" style="display: none; flex-direction: column; gap: 1rem; margin-top: 1rem;">
                    @if ($courses->isEmpty())
                    <p class="text-gray-500">No courses enrolled.</p>
                    @else
                    @foreach ($courses as $course)
                    <div style="background: #fef9c3; padding: 1rem; border-radius: 0.5rem; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">{{ $course->title }}</h3>
                        @if ($course->modules->isEmpty())
                        <p>No modules available.</p>
                        @else
                        <ul>
                            @foreach ($course->modules as $module)
                            @php
                            $moduleMark = $marks->firstWhere('module_id', $module->id);
                            @endphp
                            <li>
                                {{ $module->title }} —
                                <strong>{{ $moduleMark ? $moduleMark->mark . '%' : 'No mark yet' }}</strong>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    @endforeach
                    {{-- Progress Report Link in Grades section --}}
                    <a href="{{ route('student.progress-report') }}" style="color:#1d4ed8; font-weight:500; margin-top:1rem; display:inline-block;">Progress Report</a>
                    @endif
                </div>

                <!-- Profile -->
                <div class="cards-section" id="profile-cards" style="display: none; flex-wrap: wrap; gap: 1rem; margin-top: 1rem;">
                    <div style="background: #ede9fe; padding: 1rem; border-radius: 0.5rem; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">Name</h3>
                        <p>{{ Auth::user()->name }}</p>
                    </div>
                    <div style="background: #ede9fe; padding: 1rem; border-radius: 0.5rem; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">Email</h3>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                    <a href="{{ route('student.progress-report') }}" style="color:#1d4ed8; font-weight:500;">Progress Report</a>
                </div>
            </main>
        </div>
    </div>
    

    <!-- Temporary Footer (Replace with your fixed FEEfooter) -->
    <footer style="background: #1d4ed8; color: white; padding: 1rem; text-align: center;">
        @include('components.FEEfooter')
    </footer>

    <script>
        const links = {
            'dashboard-link': 'dashboard-cards',
            'courses-link': 'courses-cards',
            'grades-link': 'grades-cards',
            'profile-link': 'profile-cards'
        };

        Object.keys(links).forEach(linkId => {
            document.getElementById(linkId).addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.cards-section').forEach(section => {
                    section.style.display = 'none';
                });
                document.getElementById(links[linkId]).style.display = 'flex';
            });
        });

        // Modal toggle functionality
        document.getElementById('enroll-button').addEventListener('click', function() {
            document.getElementById('enroll-modal').style.display = 'flex';
        });

        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('enroll-modal').style.display = 'none';
        });

        // Close modal when clicking outside the modal content
        document.getElementById('enroll-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });
    </script>
</x-app-layout>