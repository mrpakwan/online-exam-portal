<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Question to: ') . $exam->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('lecturer.questions.store', $exam) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('post')

                        <div>
                            <x-input-label for="question_text" :value="__('Question')" />
                            <x-text-input id="question_text" name="question_text" type="text" class="mt-1 block w-full" :value="old('question_text')" required autofocus autocomplete="question_text" />
                            <x-input-error class="mt-2" :messages="$errors->get('question_text')" />
                        </div>

                        <div>
                            <x-input-label for="type" :value="__('Question Type')" />
                            <x-select id="type" name="type" class="mt-1 block w-full" :value="old('type')" required autofocus  :options="$optQuestionTypes" autocomplete="type" />
                        </div>

                        <div id="mcqOptions">
                            <div>
                                <x-input-label for="options1" :value="__('Option 1')" />
                                <x-text-input id="options1" name="options[]" type="text" class="mt-1 block w-full" :value="old('options[]')" required autofocus autocomplete="options[]" />
                            </div>

                            <div>
                                <x-input-label for="options2" :value="__('Option 2')" />
                                <x-text-input id="options2" name="options[]" type="text" class="mt-1 block w-full" :value="old('options[]')" required autofocus autocomplete="options[]" />
                            </div>

                            <div>
                                <x-input-label for="options3" :value="__('Option 3')" />
                                <x-text-input id="options3" name="options[]" type="text" class="mt-1 block w-full" :value="old('options[]')" required autofocus autocomplete="options[]" />
                            </div>

                            <div>
                                <x-input-label for="options4" :value="__('Option 4')" />
                                <x-text-input id="options4" name="options[]" type="text" class="mt-1 block w-full" :value="old('options[]')" required autofocus autocomplete="options[]" />
                            </div>

                            <div>
                                <x-input-label for="correct_option" :value="__('Correct Option (0-3)')" />
                                <x-text-input id="correct_option" name="correct_option" type="number" class="mt-1 block w-full" :value="old('correct_option')" required autofocus autocomplete="correct_option" />
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Add Question') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const typeSelect = document.getElementById('type');
    const mcqOptions = document.getElementById('mcqOptions');

    typeSelect.addEventListener('change', function() {
        mcqOptions.style.display = this.value === 'mcq' ? 'block' : 'none';
    });

    // Initial state
    mcqOptions.style.display = typeSelect.value === 'mcq' ? 'block' : 'none';
</script>

</x-app-layout>