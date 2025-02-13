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
                        @if($overtime->file_name)
                            <li>
                                <a class="text-orange-500" href="{{ Storage::url($overtime->file_name)  }}" download>
                                    View attached file
                                    <svg
                                        class="inline-block h-5 w-5 text-orange-500"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0 1 12 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" />
                                    </svg>
                                </a>
                            </li>
                        @endif
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
