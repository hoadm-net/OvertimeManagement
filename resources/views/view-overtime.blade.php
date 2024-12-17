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
                        <li><strong>{{ __("Status") }}:</strong>
                            @if ($overtime->status == 'pending')
                            <span style='color: black'>{{ __("Pending") }}</span>
                            @elseif ($overtime->status == 'urgent')
                                <span style='color: #ff4c00'>{{ __("Urgent") }}</span>
                            @elseif ($overtime->status == 'manager_approved')
                                <span style='color: #1d4ed8'>{{ __("The manager has approved") }}</span>
                            @elseif ($overtime->status == 'bod_approved')
                            <span style='color: #047857'>{{ __("The director has approved") }}</span>
                            @else
                            <span style='color: #888888; text-decoration: line-through'>{{ __("Has been declined") }}</span>
                            @endif
                        </li>
                    </ul>
                    <hr class="mb-4">

                    @if ($overtime->manager_approved_at)
                        <h2 class="text-xl mb-2 text-blue-500">{{ __("Manager's Approval Information") }}</h2>
                        <ul class="list-disc ml-4 mb-4">
                            <li><strong>{{ __("Manager Name") }}:</strong> {{ $overtime->manager->name }}</li>
                            <li><strong>{{ __("Approved At") }}:</strong> {{ date('d-m-Y H:i:s', strtotime($overtime->manager_approved_at)) }}</li>
                            <li><strong>{{ __("Notes") }}:</strong> {{ $overtime->manager_note }}</li>
                        </ul>
                        <hr class="mb-4">
                    @endif

                    @if ($overtime->bod_approved_at)
                        <h2 class="text-xl mb-2 text-blue-500">{{ __("Board of Directors' Approval Information") }}</h2>
                        <ul class="list-disc ml-4 mb-4">
                            <li><strong>{{ __("Full Name") }}:</strong> {{ $overtime->bod->name }}</li>
                            <li><strong>{{ __("Approved At") }}:</strong> {{ date('d-m-Y H:i:s', strtotime($overtime->bod_approved_at)) }}</li>
                            <li><strong>{{ __("Notes") }}:</strong> {{ $overtime->bod_note }}</li>
                        </ul>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
