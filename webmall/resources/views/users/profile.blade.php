<x-main.layout>
    <x-main.card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">My Profile</h2>
            {{-- <p class="mb-4">Update</p> --}}
        </header>

        <form method="POST" action="/user/{{ auth()->user()->id }}/update">
            @csrf
            {{-- @method('PUT') --}}
            <div class="mb-6">
                <label for="name" class="inline-block text-lg mb-2"> Name </label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                    value="{{ auth()->user()->name }}" />

                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Email</label>
                <input type="email" disabled class="border border-gray-200 rounded p-2 w-full" name="email"
                    value="{{ auth()->user()->email }}" />

                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="phone" class="inline-block text-lg mb-2">Phone</label>
                <input type="number" class="border border-gray-200 rounded p-2 w-full" name="phone"
                    value="{{ auth()->user()->phone }}" />

                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="inline-block text-lg mb-2">
                    New Password
                </label>
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password"
                    value="{{ old('password') }}" placeholder="leave blank to keep old password" />

                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password2" class="inline-block text-lg mb-2">
                    Confirm New Password
                </label>
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password_confirmation"
                    value="{{ old('password_confirmation') }}" placeholder="leave blank to keep old password" />

                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit" class="bg-info text-white rounded py-2 px-4 hover:bg-black">
                    Update
                </button>
            </div>

        </form>
    </x-main.card>
</x-main.layout>
