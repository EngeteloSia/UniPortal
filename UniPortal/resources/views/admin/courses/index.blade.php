<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-900">
            📚 Manage Courses
        </h2>
    </x-slot>

    <div class="p-6 bg-white rounded-lg shadow mt-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-700">Course List</h3>
            <a href="{{ route('admin.courses.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
               + Add Course
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-blue-100 text-blue-900 uppercase text-sm">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">Description</th>
                        <th class="px-6 py-3 text-left">Lecturer</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 text-sm">
                    @forelse ($courses as $course)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $course->id }}</td>
                            <td class="px-6 py-4 font-semibold">{{ $course->title }}</td>
                            <td class="px-6 py-4">{{ Str::limit($course->description, 50) }}</td>
                            <td class="px-6 py-4">
                                {{ $course->lecturer ? $course->lecturer->name : '—' }}
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="#" class="text-indigo-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this Course?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No courses found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
