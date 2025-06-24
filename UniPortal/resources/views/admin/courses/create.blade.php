<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-900">➕ Add New Course</h2>
    </x-slot>

    <div class="p-6 bg-white rounded-lg shadow mt-4 max-w-lg mx-auto">
        <form action="{{ route('admin.courses.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label for="title" class="block font-semibold mb-1">Title <span class="text-red-600">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600" />
                @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block font-semibold mb-1">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="lecturer_id" class="block font-semibold mb-1">Lecturer</label>
                <select name="lecturer_id" id="lecturer_id" class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="">-- Select Lecturer (Optional) --</option>
                    @foreach (\App\Models\User::where('role', 'lecturer')->get() as $lecturer)
                        <option value="{{ $lecturer->id }}" {{ old('lecturer_id') == $lecturer->id ? 'selected' : '' }}>
                            {{ $lecturer->name }}
                        </option>
                    @endforeach
                </select>
                @error('lecturer_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                Save Course
            </button>
        </form>
    </div>
</x-app-layout>
