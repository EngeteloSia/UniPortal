<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-900">📊 Progress Report</h2>
    </x-slot>

    <div class="p-6 bg-white rounded-lg shadow mt-4">
        <table class="min-w-full table-auto border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-blue-100 text-blue-900 uppercase text-sm">
                <tr>
                    <th class="px-6 py-3 text-left">Course</th>
                    <th class="px-6 py-3 text-left">Assessment</th>
                    <th class="px-6 py-3 text-left">Mark</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($marks as $mark)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $mark->course->title }}</td>
                        <td class="px-6 py-4">{{ $mark->assessment_type ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $mark->mark }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">No marks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
