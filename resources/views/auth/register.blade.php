<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-blue-50">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <h1 class="text-3xl font-bold text-blue-600">ICE IT Solutions</h1>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-label for="name" value="{{ __('Name') }}" class="text-gray-700" />
                    <x-input id="name" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                            type="text" 
                            name="name" 
                            :value="old('name')" 
                            required 
                            autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" class="text-gray-700" />
                    <x-input id="email" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" class="text-gray-700" />
                    <x-input id="password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            type="password"
                            name="password"
                            required 
                            autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-gray-700" />
                    <x-input id="password_confirmation" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            type="password"
                            name="password_confirmation" 
                            required />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <a class="text-sm text-blue-600 hover:text-blue-800" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button class="bg-blue-600 hover:bg-blue-700">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>