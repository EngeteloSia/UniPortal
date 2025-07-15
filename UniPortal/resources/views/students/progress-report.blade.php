
<x-app-layout>
    <div class="container" style="padding:2rem;">
        <a href="{{ route('student.progress-report.pdf') }}" target="_blank" style="background:#1d4ed8; color:white; padding:0.5rem 1rem; border-radius:0.25rem; text-decoration:none; font-weight:500; float:right; margin-bottom:1rem;">
            Download PDF
        </a>
        <h2>Progress Report for {{ $student->name }}</h2>
        @foreach($courses as $course)
            <div style="margin-bottom:2rem;">
                <h4>{{ $course->title }}</h4>
                @if($course->modules->isEmpty())
                    <p>No modules for this course.</p>
                @else
                    <table style="width:100%; border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th style="border-bottom:1px solid #ccc;">Module</th>
                                <th style="border-bottom:1px solid #ccc;">Mark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($course->modules as $module)
                                @php
                                    $mark = $module->marks->where('student_id', $student->id)->first();
                                @endphp
                                <tr>
                                    <td>{{ $module->title }}</td>
                                    <td>
                                        {{ $mark ? $mark->mark . '%' : 'No mark yet' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        @endforeach
    </div>
</x-app-layout>