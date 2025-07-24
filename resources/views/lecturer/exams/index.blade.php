<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Exams') }}
        </h2>
    </x-slot>

   <div class="py-12">
   <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                <a href="lecturer.exams.export" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm mb-4 inline-block">{{ __('Export to Excel') }}</a>
                <a href="{{ route('lecturer.exams.create') }}"  class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm mb-4 inline-block">{{ __('Create New Exam') }}</a>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2 text-left">{{ __('Title') }}</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">{{ __('Subject') }}</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">{{ __('Start') }}</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">{{ __('End') }}</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($exams as $exam)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">{{ $exam->title }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $exam->subject->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $exam->start_time }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $exam->end_time }}</td>
                                <td class="border border-gray-300 px-4 py-2 space-x-2">
                                    <!-- <a href="{{ route('lecturer.questions.create', $exam) }}" class="text-blue-600 hover:underline text-sm">{{ __('Add Questions') }}</a> -->
                                    <a href="{{ route('lecturer.questions.index', $exam) }}" class="text-indigo-600 hover:underline text-sm">{{ __('View Questions') }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
      </div>
   </div>
</x-app-layout>