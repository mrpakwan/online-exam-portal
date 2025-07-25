<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                    <div class="p-4 bg-gray-100 rounded text-gray-700 shadow-inner">
                        <p class="text-lg font-semibold">Total Students</p>
                        <p class="text-2xl">{{ $students }}</p>
                    </div>

                    <div class="p-4 bg-gray-100 rounded text-gray-700 shadow-inner">
                        <p class="text-lg font-semibold">Total Subjects</p>
                        <p class="text-2xl">{{ count($subjects) }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Recent Exams</h3>
                    <ul class="list-disc list-inside space-y-2 text-gray-700">
                        @forelse($exams as $exam)
                            <li>
                                <span class="font-medium">{{ $exam->title }}</span>
                                <span class="text-sm text-gray-500"> – {{ $exam->subject->name }}</span>
                            </li>
                        @empty
                            <li class="text-gray-500">No recent exams available.</li>
                        @endforelse
                    </ul>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
