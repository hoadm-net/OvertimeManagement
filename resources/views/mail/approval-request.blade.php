<div>
    <h3>Overtime Information</h3>
    <ul>
        <li>Full Name: {{ $overtime->name }}</li>
        <li>Department: {{ $overtime->deparment->name }}</li>
        <li>Shift: {{ $overtime->shift }}</li>
        <li>Start Time: {{ date('d-m-Y H:i', strtotime($overtime->begin)) }}</li>
        <li>End Time: {{ date('d-m-Y H:i', strtotime($overtime->end)) }}</li>
        <li>Job Description: {{ $overtime->description  }}</li>
        <li>Company Bus: @if($overtime->bus)Yes @else No @endif</li>
        <li>Status:
            @if ($ot->status == 'pending')
                <span style='color: black'>{{ __("Pending") }}</span>
            @elseif ($ot->status == 'urgent')
                <span style='color: #ff4c00'>{{ __("Urgent") }}</span>
            @elseif ($ot->status == 'manager_approved')
                <span style='color: #1d4ed8'>{{ __("The manager has approved") }}</span>
            @elseif ($ot->status == 'bod_approved')
                <span style='color: #047857'>{{ __("The director has approved") }}</span>
            @else
                <span style='color: #888888; text-decoration: line-through'>{{ __("Has been declined") }}</span>
            @endif
        </li>
    </ul>
</div>
