<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leaderboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                <table class="min-w-full divide-y divide-gray-200 table-auto border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">{{ __('Rank') }}</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">{{ __('Student') }}</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">{{ __('Score') }}</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">{{ __('Correct / Total') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($scores as $i => $row)
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $i + 1 }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $row['name'] }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $row['score'] }}%</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $row['correct'] }} / {{ $row['total'] }}</td>
                            </tr>
                        @endforeach

                        @if (empty($scores))
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-700" colspan="4">{{ __('No record(s) found') }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    </div>
</x-app-layout>
