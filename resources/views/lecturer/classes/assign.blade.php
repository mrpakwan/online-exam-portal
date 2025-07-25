<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign Students to ') . $classGroup->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">
                <form method="POST" action="{{ route('lecturer.classes.assign.store', $classGroup) }}">
                    @csrf

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Select Students</h3>

                        <div class="max-h-80 overflow-y-auto border rounded-md p-4 space-y-2">
                            @foreach ($students as $student)
                                <label class="flex items-center space-x-3 text-sm text-gray-700">
                                    <input type="checkbox" name="student_ids[]" value="{{ $student->id }}"
                                           {{ $student->class_group_id == $classGroup->id ? 'checked' : '' }}
                                           class="form-checkbox h-4 w-4 text-blue-600">
                                    <span>{{ $student->name }} ({{ $student->email }})</span>
                                </label>
                            @endforeach
                        </div>

                        @error('student_ids')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                        @enderror
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
                              {{ __('Assign Students') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
