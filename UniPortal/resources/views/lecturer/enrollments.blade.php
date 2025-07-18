@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Enrollment Requests</h1>

    @if($requests->isEmpty())
    <p>No enrollment requests at the moment.</p>
    @else
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">Student Name</th>
                <th class="border border-gray-300 px-4 py-2">Course</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Requested At</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $request->student->name }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $request->course->title }}</td>
                <td class="border border-gray-300 px-4 py-2 capitalize">{{ $request->status }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $request->created_at->format('Y-m-d H:i') }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    @if($request->status === 'pending')
                    <form action="{{ route('lecturer.enrollments.update', $request->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button name="status" value="accepted" class="bg-blue-600 text-white px-3 py-1 rounded shadow hover:bg-blue-700">
                            Accept
                        </button>
                    </form>
                    <form action="{{ route('lecturer.enrollments.update', $request->id) }}" method="POST" class="inline ml-2">
                        @csrf
                        @method('PATCH')
                        <button name="status" value="rejected" class="bg-blue-500 !text-black px-3 py-1 rounded hover:bg-blue-600">
                            ✖️
                        </button>

                    </form>
                    @else
                    <span class="italic">{{ ucfirst($request->status) }}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection