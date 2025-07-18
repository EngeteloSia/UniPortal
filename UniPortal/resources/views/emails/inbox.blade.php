<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-pink-700 leading-tight">📥 Inbox</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-4">
        @if($messages->isEmpty())
            <p>No messages found.</p>
        @else
            <ul class="divide-y divide-gray-200">
                @foreach ($messages as $message)
                    <li class="py-4">
                        <a href="{{ route('email.show', $message->id) }}" class="block hover:bg-gray-100 p-2 rounded">
                            <div class="flex justify-between">
                                <div>
                                    <strong>From:</strong> {{ $message->sender->name }} <br>
                                    <strong>To:</strong> {{ $message->recipient->name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $message->created_at->diffForHumans() }}
                                </div>
                            </div>
                            <div>
                                <strong>Subject:</strong> {{ $message->subject }}
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
