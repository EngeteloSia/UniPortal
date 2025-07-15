
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Progress Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; margin: 30px; }
        h2 { color: #1d4ed8; border-bottom: 2px solid #1d4ed8; padding-bottom: 8px; }
        h4 { margin-bottom: 0; color: #374151; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; }
        th, td { border: 1px solid #d1d5db; padding: 8px; text-align: left; }
        th { background: #f3f4f6; }
        .footer { text-align: center; color: #6b7280; font-size: 0.9rem; margin-top: 2rem; }
    </style>
</head>
<body>
    <h2>Progress Report</h2>
    <p><strong>Student:</strong> {{ $student->name }}<br>
    <strong>Email:</strong> {{ $student->email }}</p>
    <p><strong>Date:</strong> {{ \Carbon\Carbon::now()->format('d M Y') }}</p>

    @foreach($courses as $course)
        <h4>{{ $course->title }}</h4>
        @if($course->modules->isEmpty())
            <p>No modules for this course.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Module</th>
                        <th>Mark</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($course->modules as $module)
                        @php
                            $mark = $module->marks->where('student_id', $student->id)->first();
                        @endphp
                        <tr>
                            <td>{{ $module->title }}</td>
                            <td>{{ $mark ? $mark->mark . '%' : 'No mark yet' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endforeach

    <div class="footer">
        &copy; {{ date('Y') }} UniPortal. Generated on {{ \Carbon\Carbon::now()->format('d M Y H:i') }}
    </div>
</body>
</html>