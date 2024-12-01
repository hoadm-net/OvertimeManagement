<?php

namespace App\Livewire;

use App\Exports\OvertimeExport;
use App\Models\Department;
use App\Models\Overtime;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;


class StatOvertime extends Component
{
    use WithPagination;

    public $begin = null;
    public $end = null;
    public $status = null;
    public $department = null;

    public function render()
    {
        $query = Overtime::query();

        if ($this->begin) {
            $query->whereDate('begin', '>=', $this->begin);
        }

        if ($this->end) {
            $query->whereDate('end', '<=', $this->end);
        }

        if ($this->department) {
            $query->where('department_id', $this->department);
        }

        if ($this->status != '') {
            $query->where('status', $this->status);
        }

        $overtimes = $query->paginate(10);


        return view('livewire.stat-overtime', [
            'departments' => Department::all(),
            'overtimes' => $overtimes,
        ]);
    }

    public function clear() {
        $this->begin = null;
        $this->end = null;
        $this->status = null;
        $this->department = null;
    }

    public function export() {
        return (new OvertimeExport($this->begin, $this->end, $this->status, $this->department))
            ->download('overtimes.xlsx');
    }
}
