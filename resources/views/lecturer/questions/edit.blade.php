<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Question') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('lecturer.questions.update', [$exam, $question]) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <x-input-label for="type" :value="__('Question Type')" />
                            <x-text-input id="type" name="" type="text" class="mt-1 block w-full" :value="old('type', $question->type)" disabled autofocus autocomplete="type" />
                            <x-input-error class="mt-2" :messages="$errors->get('type')" />
                        </div>

                        <div>
                            <x-input-label for="question_text" :value="__('Question Text')" />
                            <x-text-input id="question_text" name="question_text" type="text" class="mt-1 block w-full" :value="old('question_text', $question->question_text)" required autofocus autocomplete="question_text" />
                            <x-input-error class="mt-2" :messages="$errors->get('question_text')" />
                        </div>

                        @if ($question->type === 'mcq')
                            <x-input-label for="" :value="__('Options')" />
                            @foreach ($question->options()->orderBy('id')->get() as $index => $option)
                                <div class="mb-2">
                                    <input type="radio" name="correct_option" value="{{ $index }}" {{ $option->is_correct == ($index) ? 'checked' : '' }}>
                                    <input type="text" name="options[]" class="form-control d-inline-block w-75" value="{{ $option->option_text }}">
                                </div>
                            @endforeach
                        @endif
                        
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update Question') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
