<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dodaj nowego użytkownika') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block font-medium text-sm text-gray-700">{{ __('Nazwa użytkownika') }}</label>
                            <input id="name" class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" name="name" required autofocus />
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block font-medium text-sm text-gray-700">{{ __('Email') }}</label>
                            <input id="email" class="form-input rounded-md shadow-sm mt-1 block w-full" type="email" name="email" required />
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block font-medium text-sm text-gray-700">{{ __('Hasło') }}</label>
                            <input id="password" class="form-input rounded-md shadow-sm mt-1 block w-full" type="password" name="password" required />
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">{{ __('Potwierdź hasło') }}</label>
                            <input id="password_confirmation" class="form-input rounded-md shadow-sm mt-1 block w-full" type="password" name="password_confirmation" required />
                        </div>

                        <div class="mb-4">
                            <label for="case_manager" class="block font-medium text-sm text-gray-700">Prowadzący sprawę (ID użytkownika):</label>
                            <input id="case_manager" class="form-input rounded-md shadow-sm mt-1 block w-full" type="text" name="case_manager" maxlength="6" required>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 active:bg-blue-900 focus:border-blue-900 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                {{ __('Dodaj użytkownika') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
