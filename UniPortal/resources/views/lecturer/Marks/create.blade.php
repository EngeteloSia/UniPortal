<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-900">📝 Enter Student Marks</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded-lg mt-4">
        <form action="{{ route('lecturer.marks.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold">Student</label>
                <select name="student_id" class="w-full border border-gray-300 rounded px-3 py-2">
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold">Course</label>
                <select name="course_id" class="w-full border border-gray-300 rounded px-3 py-2">
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold">Assessment Type</label>
                <input type="text" name="assessment_type" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="e.g. Test, Exam" required>
            </div>

            <div>
                <label class="block text-sm font-semibold">Mark</label>
                <input type="number" name="mark" class="w-full border border-gray-300 rounded px-3 py-2" required>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save Mark
            </button>
        </form>
    </div>
</x-app-layout>
