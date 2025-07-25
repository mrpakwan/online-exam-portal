<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Exam') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6 sm:p-8">
                <form method="POST" action="{{ route('lecturer.exams.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">{{ __('Title') }}</label>
                        <input id="title" name="title" type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            value="{{ old('title') }}" required autofocus autocomplete="title">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="subject_id" class="block text-sm font-medium text-gray-700">{{ __('Subject') }}</label>
                        <select id="subject_id" name="subject_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required>
                            <option value="">-- Select Subject --</option>
                            @foreach($optSubjects as $subject)
                                <option value="{{ $subject['value'] }}" {{ old('subject_id') == $subject['value'] ? 'selected' : '' }}>
                                    {{ $subject['name'] }}
                                </option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700">{{ __('Duration') }}</label>
                        <input id="duration" name="duration" type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            value="{{ old('duration') }}" required autofocus autocomplete="duration">
                        @error('duration')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700 transition">
                            {{ __('Create') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
