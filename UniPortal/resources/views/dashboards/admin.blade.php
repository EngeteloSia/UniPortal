<x-app-layout>
    <x-slot name="header">
        <h2 style="font-weight: 600; font-size: 1.25rem; color: #1f2937; line-height: 1.5;">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div style="font-family: sans-serif; margin: 0; padding: 0; background: #f3f4f6;">
        <header style="background-color: #1e3a8a; color: white; padding: 1rem; display: flex; justify-content: space-between; align-items: center;">
            <div style="font-size: 1.5rem; font-weight: bold;">🛠️ Admin Portal</div>
            <div>Logged in as: {{ Auth::user()->name }}</div>
        </header>

        <div style="display: flex; padding: 1rem;">
            <aside style="width: 200px; background: white; padding: 1rem; border-right: 1px solid #ccc;">
                <nav>
                    <a href="#" style="display: block; margin-bottom: 0.5rem; color: #1e3a8a; text-decoration: none; font-weight: 500;">Dashboard</a>
                    <a href="{{ route('admin.users.index') }}" style="display: block; margin-bottom: 0.5rem; color: #1e3a8a; text-decoration: none; font-weight: 500;">Manage Users</a>
                    <a href="{{ route('admin.courses.index') }}" style="display: block; margin-bottom: 0.5rem; color: #1e3a8a; text-decoration: none; font-weight: 500;">Manage Courses</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="display: block; color: red; font-weight: 500;">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                </nav>
            </aside>

            <main style="flex: 1; padding: 1rem; background: white; margin-left: 1rem; border-radius: 0.5rem; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
                <h1 style="font-size: 1.5rem; font-weight: bold;">Welcome, Admin</h1>
                <p style="color: #4b5563;">Here is a quick overview of the system statistics.</p>

                <div style="display: flex; flex-wrap: wrap; gap: 1rem; margin-top: 1rem;">
                    <div style="background: #d1fae5; padding: 1rem; border-radius: 0.5rem; flex: 1 1 200px; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">Total Students</h3>
                        <p>{{ $students->count() }}</p>
                    </div>
                    <div style="background: #dbeafe; padding: 1rem; border-radius: 0.5rem; flex: 1 1 200px; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">Total Lecturers</h3>
                        <p>{{ $lecturers->count() }}</p>
                    </div>
                    <div style="background: #fef3c7; padding: 1rem; border-radius: 0.5rem; flex: 1 1 200px; box-shadow: 0 1px 4px rgba(0,0,0,0.1);">
                        <h3 style="margin-top: 0; font-weight: bold;">Total Courses</h3>
                        <p>{{ $courses->count() }}</p>
                    </div>
                </div>
            </main>
        </div>
    </div>
     @include('components.FEEfooter')
</x-app-layout>
