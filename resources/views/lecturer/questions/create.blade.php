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

                    <div class="mb-4">
                        <label for="type" class="block font-medium text-sm text-gray-700">Question Type</label>
                        <select id="type" name="type" class="form-select mt-1 block w-full" onchange="toggleOptions(this.value)">
                            <option value="mcq">Multiple Choice</option>
                            <option value="open">Open Text</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="question_text" class="block font-medium text-sm text-gray-700">Question Text</label>
                        <textarea name="question_text" id="question_text" class="form-input w-full" rows="3" required></textarea>
                    </div>

                    {{-- MCQ Fields --}}
                    <div id="mcq-options">
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700">Options</label>
                            @for ($i = 0; $i < 4; $i++)
                                <div class="flex items-center space-x-2 mb-2">
                                    <input type="radio" name="correct_option" value="{{ $i }}" required>
                                    <input type="text" name="options[]" class="form-input flex-1" placeholder="Option {{ $i + 1 }}">
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">
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

            // Disable inputs when hidden so they don't submit
            const inputs = optionsDiv.querySelectorAll('input');
            inputs.forEach(input => {
                input.disabled = (type !== 'mcq');
            });
        }

        // Init based on default value
        document.addEventListener('DOMContentLoaded', () => {
            toggleOptions(document.getElementById('type').value);
        });
    </script>
</x-app-layout>
