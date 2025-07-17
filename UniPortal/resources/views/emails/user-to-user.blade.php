<!DOCTYPE html>
<html>
<head>
    <title>{{ $subjectLine ?? 'Message from ' . $senderName }}</title>
</head>
<body>
    <p><strong>{{ $senderName }}</strong> sent you the following message:</p>

    <p>{!! nl2br(e($messageBody)) !!}</p>

    <hr>
    <p>This email was sent via the Student Management System.</p>
</body>
</html>
