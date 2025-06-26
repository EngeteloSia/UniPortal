<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-900">📝 Enter Student Marks</h2>
    </x-slot>

    <div class="p-6 bg-white shadow rounded-lg mt-4">
        <form action="{{ route('lecturer.marks.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold">Student</label>
                <select name="student_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold">Course</label>
                <select name="course_id" id="course-select" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    <option value="">-- Select Course --</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold">Module</label>
                <select name="module_id" id="module-select" class="w-full border border-gray-300 rounded px-3 py-2" required disabled>
                    <option value="">-- Select Module --</option>
                    {{-- Modules will be populated dynamically --}}
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold">Assessment Type</label>
                <input type="text" name="assessment_type" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="e.g. Test, Exam" required>
            </div>

            <div>
                <label class="block text-sm font-semibold">Mark</label>
                <input type="number" name="mark" class="w-full border border-gray-300 rounded px-3 py-2" min="0" max="100" step="0.01" required>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save Mark
            </button>
        </form>
    </div>

    <script>
    const courseSelect = document.getElementById('course-select');
    const moduleSelect = document.getElementById('module-select');

    courseSelect.addEventListener('change', async function() {
        const courseId = this.value;

        if (!courseId) {
            moduleSelect.innerHTML = '<option value="">-- Select Module --</option>';
            moduleSelect.disabled = true;
            return;
        }

        moduleSelect.innerHTML = '<option>Loading modules...</option>';
        moduleSelect.disabled = true;

        try {
            const response = await fetch(`/api/courses/${courseId}/modules`, {
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Laravel Blade directive outputs CSRF token
                }
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const modules = await response.json();

            moduleSelect.innerHTML = '<option value="">-- Select Module --</option>';
            modules.forEach(module => {
                const option = document.createElement('option');
                option.value = module.id;
                option.textContent = module.title;
                moduleSelect.appendChild(option);
            });
            moduleSelect.disabled = false;
        } catch (error) {
            console.error('Error loading modules:', error);
            moduleSelect.innerHTML = '<option value="">Failed to load modules</option>';
        }
    });
</script>

</x-app-layout>
