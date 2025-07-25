<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Exam Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                @if (count($results))
                    <table class="table-auto w-full border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="p-2 border">{{ __('Exam') }}</th>
                                <th class="p-2 border">{{ __('Total Questions') }}</th>
                                <th class="p-2 border">{{ __('Correct') }}</th>
                                <th class="p-2 border">{{ __('Score') }}</th>
                                <th class="p-2 border">{{ __('Submitted Date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $row)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-2 border">{{ $row['exam']->title }}</td>
                                    <td class="p-2 border">{{ $row['total'] }}</td>
                                    <td class="p-2 border">{{ $row['correct'] }}</td>
                                    <td class="p-2 border">{{ $row['percentage'] }}%</td>
                                    <td class="p-2 border">{{ $row['submitted_at']->format('Y-m-d H:i:s') ?? __('N/A') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>{{ __('No results available.') }}</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
