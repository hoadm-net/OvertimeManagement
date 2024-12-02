<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Overtime;
use Carbon\Carbon;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $department;
    public $begin;
    public $end;
    public $description;

    protected $rules = [
        'name' => 'required',
        'department' => 'required',
        'begin' => 'required',
        'end' => 'required|after:begin',
        'description' => 'nullable',
    ];

    public function render()
    {
        return view('livewire.register', [
            'departments' => Department::all()
        ]);
    }

    public function submit() {

        $this->validate();

        $formattedBegin = Carbon::createFromFormat('d-m-Y H:i', $this->begin)->format('Y-m-d H:i:s');
        $formattedEnd = Carbon::createFromFormat('d-m-Y H:i', $this->end)->format('Y-m-d H:i:s');

        $ticket = Overtime::create([
            'name' => mb_convert_case($this->name, MB_CASE_TITLE, "UTF-8"),
            'department_id' => $this->department,
            'begin' => $formattedBegin,
            'end' => $formattedEnd,
            'description' => $this->description
        ]);

        return redirect('thanks');
    }


}
