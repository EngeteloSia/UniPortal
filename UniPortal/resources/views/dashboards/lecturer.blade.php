<x-app-layout>
    <x-slot name="header">
        <style>
            .cards-section {
                display: none;
            }
            .cards-section.active {
                display: block;
            }
        </style>
        <h2 style="font-weight: 600; font-size: 1.25rem; color: #1f2937; line-height: 1.5;">
            {{ __('Lecturer Dashboard') }}
        </h2>
    </x-slot>

    <div style="padding: 1.5rem 1rem; background-color: #f9fafb;">
        <div style="display: grid; grid-template-columns: 1fr; gap: 1rem; margin-bottom: 1.5rem;" class="md:grid-cols-4">
            <!-- Sidebar -->
            <nav style="background-color: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 0.5rem; padding: 1rem;">
                <div style="font-weight: bold; font-size: 1.125rem; margin-bottom: 0.5rem;">📗 Lecturer Portal</div>
                <div style="font-size: 0.875rem; color: #4b5563; margin-bottom: 1rem;">Logged in as: {{ Auth::user()->name }}</div>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li><a href="#" id="dashboard-link" style="display: block; margin-bottom: 0.5rem; color: #2563eb; text-decoration: none;">Dashboard</a></li>
                    <li><a href="#" id="courses-link" style="display: block; margin-bottom: 0.5rem; color: #2563eb; text-decoration: none;">Manage Courses</a></li>
                    <li><a href="#" id="students-link" style="display: block; margin-bottom: 0.5rem; color: #2563eb; text-decoration: none;">Enrolled Students</a></li>
                    <li><a href="#" id="profile-link" style="display: block; margin-bottom: 0.5rem; color: #2563eb; text-decoration: none;">Profile</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #dc2626; text-decoration: none;">Logout</a></li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            </nav>

            <!-- Main Content -->
            <main style="grid-column: span 3 / span 3; background-color: white; border-radius: 0.5rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                <h1 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 0.5rem;">Welcome, {{ Auth::user()->name }}!</h1>
                <p style="color: #4b5563; margin-bottom: 1.5rem;">Manage your courses and student records efficiently.</p>

                <!-- Dashboard -->
                <div class="cards-section active" id="dashboard-cards" style="display: block;">
                    <div style="display: grid; gap: 1rem;" class="md:grid-cols-3">
                        <div style="background-color: #d1fae5; padding: 1rem; border-radius: 0.5rem;">
                            <h3 style="font-weight: 600;">Courses Taught</h3>
                            <p>3</p>
                        </div>
                        <div style="background-color: #d1fae5; padding: 1rem; border-radius: 0.5rem;">
                            <h3 style="font-weight: 600;">Students Enrolled</h3>
                            <p>120</p>
                        </div>
                        <div style="background-color: #d1fae5; padding: 1rem; border-radius: 0.5rem;">
                            <h3 style="font-weight: 600;">Pending Assignments</h3>
                            <p>8</p>
                        </div>
                    </div>
                </div>

                <!-- Manage Courses -->
                <div class="cards-section" id="courses-cards" style="display: none;">
                    <div style="display: grid; gap: 1rem;" class="md:grid-cols-2">
                        <div style="background-color: #fef9c3; padding: 1rem; border-radius: 0.5rem;">
                            <h3 style="font-weight: 600;">Active Courses</h3>
                            <p>2</p>
                        </div>
                        <div style="background-color: #fef9c3; padding: 1rem; border-radius: 0.5rem;">
                            <h3 style="font-weight: 600;">Archived Courses</h3>
                            <p>1</p>
                        </div>
                    </div>
                </div>

                <!-- Enrolled Students -->
                <div class="cards-section" id="students-cards" style="display: none;">
                    <div style="display: grid; gap: 1rem;" class="md:grid-cols-2">
                        <div style="background-color: #bfdbfe; padding: 1rem; border-radius: 0.5rem;">
                            <h3 style="font-weight: 600;">Total Students</h3>
                            <p>120</p>
                        </div>
                        <div style="background-color: #bfdbfe; padding: 1rem; border-radius: 0.5rem;">
                            <h3 style="font-weight: 600;">Top Performer</h3>
                            <p>Jane Doe</p>
                        </div>
                    </div>
                </div>

                <!-- Profile -->
                <div class="cards-section" id="profile-cards" style="display: none;">
                    <div style="display: grid; gap: 1rem;" class="md:grid-cols-2">
                        <div style="background-color: #e9d5ff; padding: 1rem; border-radius: 0.5rem;">
                            <h3 style="font-weight: 600;">Name</h3>
                            <p>Lecturer Name</p>
                        </div>
                        <div style="background-color: #e9d5ff; padding: 1rem; border-radius: 0.5rem;">
                            <h3 style="font-weight: 600;">Email</h3>
                            <p>lecturer@email.com</p>
                        </div>
                    </div>
                </div>
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
            document.getElementById(linkId).addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelectorAll('.cards-section').forEach(section => {
                    section.style.display = 'none';
                });
                document.getElementById(links[linkId]).style.display = 'block';
            });
        });
    </script>
</x-app-layout>
