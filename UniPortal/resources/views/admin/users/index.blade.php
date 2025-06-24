<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-900">
            🧑‍💼 Manage Users
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-100 p-4 h-full min-h-screen border-r">
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block text-blue-900 font-semibold hover:underline">🏠 Dashboard</a>
                <a href="{{ route('admin.users.index') }}" class="block text-blue-900 font-semibold hover:underline">👤 Manage Users</a>
                <a href="{{ route('admin.courses.index') }}" class="block text-blue-900 font-semibold hover:underline">📚 Manage Courses</a>
                <!-- Add more links as needed -->
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 bg-white">
            <div class="bg-white rounded-lg shadow">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">User List</h3>
                    <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">+ Add User</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="bg-blue-100 text-blue-900 uppercase text-sm">
                            <tr>
                                <th class="px-6 py-3 text-left">ID</th>
                                <th class="px-6 py-3 text-left">Name</th>
                                <th class="px-6 py-3 text-left">Email</th>
                                <th class="px-6 py-3 text-left">Role</th>
                                <th class="px-6 py-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 text-sm">
                            @forelse ($users as $user)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $user->id }}</td>
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4 capitalize">{{ $user->role }}</td>
                                    <td class="px-6 py-4 space-x-2">
                                        <a href="#" class="text-indigo-600 hover:underline">Edit</a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
