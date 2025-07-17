<form action="{{ $formAction }}" method="POST" class="email-form" style="max-width:600px; margin-top:1rem;">
    @csrf

    <label for="recipient_email" style="font-weight: 600;">Recipient Email</label><br>
    <input type="email" name="recipient_email" id="recipient_email" value="{{ old('recipient_email', $recipientEmail ?? '') }}" required
        style="width: 100%; padding: 0.5rem; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 0.25rem;">

    <label for="subject" style="font-weight: 600;">Subject</label><br>
    <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
        style="width: 100%; padding: 0.5rem; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 0.25rem;">

    <label for="message" style="font-weight: 600;">Message</label><br>
    <textarea name="message" id="message" rows="6" required
        style="width: 100%; padding: 0.5rem; margin-bottom: 1rem; border: 1px solid #ccc; border-radius: 0.25rem;">{{ old('message') }}</textarea>

    <button type="submit" style="background: #1d4ed8; color: white; border: none; padding: 0.5rem 1rem; border-radius: 0.25rem; font-weight: 600; cursor: pointer;">
        Send Email
    </button>
</form>
