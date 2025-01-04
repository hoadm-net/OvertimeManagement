<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Overtime Schedule Details") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl mb-2 text-blue-500">{{ __("General Information") }}</h2>
                    <ul class="list-disc ml-6 mb-4">
                        <li><strong>{{ __("Full Name") }}:</strong> {{ $overtime->name }}</li>
                        @if ($overtime->email)
                            <li><strong>{{ __("Email") }}:</strong> {{ $overtime->email }}</li>
                        @endif
                        <li><strong>{{ __("Department") }}:</strong> {{ $overtime->department->name }}</li>
                        <li><strong>{{ __("Shift") }}: </strong> {{ $overtime->shift }}</li>
                        <li><strong>{{ __("Start Time") }}:</strong> {{  date('d-m-Y H:i:s', strtotime($overtime->begin)) }}</li>
                        <li><strong>{{ __("End Time") }}:</strong> {{ date('d-m-Y H:i:s', strtotime($overtime->end)) }}</li>
                        <li><strong>{{ __("Job Description") }}: </strong> {{ $overtime->description }}</li>
                        <li><strong>{{ __("Status") }}:</strong> <span class="capitalize">{{ $overtime->status }}</span></li>
                    </ul>
                    <hr class="mb-4">

                    @if (count($overtime->logs) > 0)
                        <h2 class="text-xl text-blue-500 mb-4">{{ __("Activity Logs") }}</h2>
                        <table class="w-full">
                            <thead class="border-b-2 font-bold">
                            <tr>
                                <td>#</td>
                                <td>Manager</td>
                                <td>Decision</td>
                                <td>Notes</td>
                                <td>Time</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($overtime->logs as $log)
                                <tr class="border-b">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $log->user->name }}</td>
                                    <td class="capitalize">{{ $log->action }}</td>
                                    <td>{{ $log->notes }}</td>
                                    <td>{{ $log->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
