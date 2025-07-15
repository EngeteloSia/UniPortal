<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Progress Report</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            margin: 30px;
            font-size: 11pt;
            line-height: 1.4;
        }
        .header-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #1D4ED8;
            padding-bottom: 8px;
        }
        .header-logo {
            max-height: 50px;
            margin-right: 20px;
        }
        .header-title {
            color: #1D4ED8;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .student-info {
            margin-bottom: 20px;
        }
        .student-info strong {
            color: #374151;
        }
        .course-title {
            color: #374151;
            font-size: 1.1rem;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .no-modules {
            color: #374151;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #D1D5DB;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #F3F4F6;
            font-weight: bold;
            color: #374151;
        }
        .footer {
            text-align: center;
            color: #6B7280;
            font-size: 0.9rem;
            margin-top: 30px;
            border-top: 1px solid #D1D5DB;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header-container">
        <img src="{{ asset('images/logo.png') }}" alt="UniPortal Logo" class="header-logo">
        <div class="header-title">Progress Report</div>
    </div>

    <div class="student-info">
        <strong>Student:</strong> {{ $student->name }}<br>
        <strong>Email:</strong> {{ $student->email }}<br>
        <strong>Date:</strong> {{ \Carbon\Carbon::now()->format('d M Y') }}
    </div>

    @foreach($courses as $course)
        <div class="course-title">{{ $course->title }}</div>
        @if($course->modules->isEmpty())
            <div class="no-modules">No modules for this course.</div>
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
        © {{ date('Y') }} UniPortal. Generated on {{ \Carbon\Carbon::now()->format('d M Y H:i') }}
    </div>
</body>
</html>