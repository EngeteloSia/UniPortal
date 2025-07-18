<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-pink-700 leading-tight">✉️ Send Email</h2>
    </x-slot>

    <div class="py-6 px-4 max-w-2xl mx-auto">
        @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ $formAction }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="recipient_email">Select Recipient</label>
                <select name="recipient_email" required class="form-select w-full rounded border-gray-300 shadow-sm">
                    <option value="">-- Select a user --</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->email }}" {{ old('recipient_email') == $user->email ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                    @endforeach
                </select>
            </div>


            <div>
                <label for="subject">Subject</label>
                <input type="text" name="subject" value="{{ old('subject') }}"
                    required class="form-input w-full rounded border-gray-300 shadow-sm">
            </div>

            <div>
                <label for="message">Message</label>
                <textarea name="message" rows="5" required
                    class="form-textarea w-full rounded border-gray-300 shadow-sm">{{ old('message') }}</textarea>
            </div>

            <button type="submit" style="background-color: #2563eb !important; color: white !important;" 
    class="py-2 px-4 rounded hover:bg-blue-700 transition duration-200">
    Send Email
</button>

        </form>
    </div>
</x-app-layout>