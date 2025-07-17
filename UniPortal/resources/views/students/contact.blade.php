<form action="{{ route('student.contact.send') }}" method="POST">
    @csrf
    <label for="lecturer_email">Lecturer Email</label>
    <input type="email" name="lecturer_email" required class="form-input mb-4">

    <label for="subject">Subject</label>
    <input type="text" name="subject" required class="form-input mb-4">

    <label for="message">Message</label>
    <textarea name="message" required class="form-textarea mb-4"></textarea>

    <button type="submit" class="btn btn-primary">Send Email</button>
</form>
