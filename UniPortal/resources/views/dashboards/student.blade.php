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
                        <p>5</p>
                    </div>
                    <div style="background: #e0f2fe; padding: 1rem; border-radius: 0.5rem; flex: 1 1 200px; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">Average Grade</h3>
                        <p>75%</p>
                    </div>
                    <div style="background: #e0f2fe; padding: 1rem; border-radius: 0.5rem; flex: 1 1 200px; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">Upcoming Exams</h3>
                        <p>2</p>
                    </div>
                </div>

                <!-- My Courses -->
                <div class="cards-section" id="courses-cards" style="display: none; flex-wrap: wrap; gap: 1rem; margin-top: 1rem;">
                    <div style="background: #fff3cd; padding: 1rem; border-radius: 0.5rem; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">Current Courses</h3>
                        <p>Math, Science, English, History, Art</p>
                    </div>
                </div>

                <!-- Grades -->
                <div class="cards-section" id="grades-cards" style="display: none; flex-wrap: wrap; gap: 1rem; margin-top: 1rem;">
                    <div style="background: #fef9c3; padding: 1rem; border-radius: 0.5rem; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">Math</h3>
                        <p>80%</p>
                    </div>
                    <div style="background: #fef9c3; padding: 1rem; border-radius: 0.5rem; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">Science</h3>
                        <p>70%</p>
                    </div>
                    <div style="background: #fef9c3; padding: 1rem; border-radius: 0.5rem; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">English</h3>
                        <p>75%</p>
                    </div>
                </div>

                <!-- Profile -->
                <div class="cards-section" id="profile-cards" style="display: none; flex-wrap: wrap; gap: 1rem; margin-top: 1rem;">
                    <div style="background: #ede9fe; padding: 1rem; border-radius: 0.5rem; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">Name</h3>
                        <p>Student Name</p>
                    </div>
                    <div style="background: #ede9fe; padding: 1rem; border-radius: 0.5rem; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">Email</h3>
                        <p>student@email.com</p>
                    </div>
                </div>
            </main>
        </div>
    </div>

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
    </script>
</x-app-layout>
