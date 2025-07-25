<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Question for: ') . $exam->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">
                <form method="POST" action="{{ route('lecturer.questions.store', $exam) }}">
                    @csrf

                    <!-- Question Type -->
                    <div class="mb-6">
                        <label for="type" class="block text-sm font-medium text-gray-700">{{ __('Question Type') }}</label>
                        <select id="type" name="type"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            onchange="toggleOptions(this.value)">
                            <option value="mcq">Multiple Choice</option>
                            <option value="open">Open Text</option>
                        </select>
                    </div>

                    <!-- Question Text -->
                    <div class="mb-6">
                        <label for="question_text" class="block text-sm font-medium text-gray-700">{{ __('Question Text') }}</label>
                        <textarea name="question_text" id="question_text"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            rows="4" required></textarea>
                    </div>

                    <!-- MCQ Options -->
                    <div id="mcq-options">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('Options') }}</label>
                        @for ($i = 0; $i < 4; $i++)
                            <div class="flex items-center gap-2 mb-3">
                                <input type="radio" name="correct_option" value="{{ $i }}" required
                                    class="text-blue-600 focus:ring-blue-500 border-gray-300">
                                <input type="text" name="options[]"
                                    class="flex-1 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    placeholder="Option {{ $i + 1 }}">
                            </div>
                        @endfor
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-800 text-sm font-semibold rounded-md hover:bg-gray-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                            {{ __('Back') }}
                        </a>&nbsp;
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700 transition">
                            {{ __('Save Question') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleOptions(type) {
            const optionsDiv = document.getElementById('mcq-options');
            optionsDiv.style.display = (type === 'mcq') ? 'block' : 'none';

            const inputs = optionsDiv.querySelectorAll('input');
            inputs.forEach(input => {
                input.disabled = (type !== 'mcq');
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            toggleOptions(document.getElementById('type').value);
        });
    </script>
</x-app-layout>
