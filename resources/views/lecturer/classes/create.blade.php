<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Create Class Group') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">
                <form method="POST" action="{{ route('lecturer.classes.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="name">{{ __('Class Name') }}</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
                            required
                        >
                    </div>

                    <div class="mt-6 flex justify-end">
                     <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-800 text-sm font-semibold rounded-md hover:bg-gray-200">
                           <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                           </svg>
                           {{ __('Back') }}
                     </a>&nbsp;
                     <button
                           type="submit"
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
                     >
                           {{ __('Create') }}
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
