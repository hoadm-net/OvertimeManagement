<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Overtime;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ApproveOvetimes extends Component
{
    use WithPagination;

    public function render()
    {

        $departments = Auth::user()->departments->pluck('id')->toArray();
        $overtimes = [];
        if (Auth::user()->role == 'manager') {
            $overtimes = Overtime::where('status', 'pending')
                ->whereIn('department_id', $departments)
                ->paginate(10);

        } elseif (Auth::user()->role == 'bod') {
            $overtimes = Overtime::where('status', 'manager_approved')
                ->paginate(10);
        }

        return view('livewire.approve-ovetimes', [
            'overtimes' => $overtimes
        ]);
    }
}
