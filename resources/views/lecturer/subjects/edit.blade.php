<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Edit Subject') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('lecturer.subjects.update', $subject) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">{{ __('Subject Name') }}</label>
                        <input type="text" name="name" class="w-full mt-1 border rounded px-3 py-2"
                               value="{{ old('name', $subject->name) }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">{{ __('Class Group') }}</label>
                        <select name="class_group_id" class="w-full mt-1 border rounded px-3 py-2" required>
                            @foreach ($classGroups as $class)
                                <option value="{{ $class->id }}"
                                        @selected($subject->class_group_id == $class->id)>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-800 text-sm font-semibold rounded-md hover:bg-gray-200">
                           <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                           </svg>
                           {{ __('Back') }}
                     </a>&nbsp;
                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            {{ __('Update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
