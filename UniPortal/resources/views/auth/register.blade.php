<x-guest-layout>
    <h2 class="text-3xl font-bold text-center mb-6 text-white">Create Your Galactic Account</h2>

    @if (session('status'))
        <div class="mb-4 text-sm text-green-400">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-indigo-300">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                class="w-full px-4 py-2 bg-gray-800 text-white placeholder-gray-400 border border-indigo-500 rounded-lg focus:ring-2 focus:ring-indigo-400" placeholder="Enter your name" />
            @error('name')
                <p class="text-pink-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-indigo-300">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                class="w-full px-4 py-2 bg-gray-800 text-white placeholder-gray-400 border border-indigo-500 rounded-lg focus:ring-2 focus:ring-indigo-400" placeholder="you@example.com" />
            @error('email')
                <p class="text-pink-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-indigo-300">Password</label>
            <input id="password" type="password" name="password" required
                class="w-full px-4 py-2 bg-gray-800 text-white placeholder-gray-400 border border-indigo-500 rounded-lg focus:ring-2 focus:ring-indigo-400" placeholder="••••••••" />
            @error('password')
                <p class="text-pink-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-indigo-300">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="w-full px-4 py-2 bg-gray-800 text-white placeholder-gray-400 border border-indigo-500 rounded-lg focus:ring-2 focus:ring-indigo-400" placeholder="••••••••" />
            @error('password_confirmation')
                <p class="text-pink-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Role -->
        <div class="mb-4">
            <label for="role" class="block text-indigo-300">Role</label>
            <select id="role" name="role" required
                class="w-full px-4 py-2 bg-gray-800 text-white border border-indigo-500 rounded-lg focus:ring-2 focus:ring-indigo-400">
                <option value="" disabled selected>Select your role</option>
                <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                <option value="lecturer" {{ old('role') == 'lecturer' ? 'selected' : '' }}>Lecturer</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <p class="text-pink-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}" class="text-sm text-indigo-400 hover:underline">Already registered?</a>
            <button type="submit"
    class="px-5 py-3 bg-blue-700 hover:bg-blue-600 text-white font-semibold rounded-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition-all duration-300"
    style="background-color: #1d4ed8 !important;">
    Register
</button>
        </div>
    </form>
</x-guest-layout>
