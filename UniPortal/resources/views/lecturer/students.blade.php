<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Enroll Students
        </h2>
    </x-slot>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 p-2">Student Name</th>
                <th class="border border-gray-300 p-2">Email</th>
                <th class="border border-gray-300 p-2">Enroll in Course</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr>
                <td class="border border-gray-300 p-2">{{ $student->name }}</td>
                <td class="border border-gray-300 p-2">{{ $student->email }}</td>
                <td class="border border-gray-300 p-2">
                    <form method="POST" action="{{ route('lecturer.enroll') }}" class="flex gap-2">
                        @csrf
                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                        <select name="course_id" class="border rounded px-2 py-1" required>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Enroll</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
