<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-pink-700 leading-tight">✉️ Message Details</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto p-4 bg-white shadow rounded">
        <p><strong>From:</strong> {{ $message->sender->name }} ({{ $message->sender->email }})</p>
        <p><strong>To:</strong> {{ $message->recipient->name }} ({{ $message->recipient->email }})</p>
        <p><strong>Subject:</strong> {{ $message->subject }}</p>
        <p class="mt-4 whitespace-pre-line">{{ $message->body }}</p>
        <p class="mt-6 text-sm text-gray-500">Sent on {{ $message->created_at->format('d M Y, H:i') }}</p>

        <a href="{{ route('email.form', ['to' => $message->sender->email]) }}" class="inline-block mt-4 bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">
            Reply
        </a>
    </div>
</x-app-layout>
