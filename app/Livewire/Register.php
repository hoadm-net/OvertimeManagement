<?php

namespace App\Livewire;

use App\Mail\RequestCreated;
use App\Models\Department;
use App\Models\Overtime;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $department;
    public $begin;
    public $end;
    public $description;
    public $urgent = false;
    public $bus = false;
    public $shift;


    protected $rules = [
        'name' => 'required',
        'department' => 'required',
        'begin' => 'required',
        'end' => 'required|after:begin',
        'description' => 'nullable',
        'urgent' => 'required',
        'bus' => 'required',
        'shift' => 'nullable',
        'email' => 'nullable|email',
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

        $status = 'pending';
        if ($this->urgent) {
            $status = 'urgent';
        }

        $staffs = explode(',', $this->name);

        foreach ($staffs as $staff) {
            $staff = trim($staff);
            if (! empty($staff)) {
                $overtime = Overtime::create([
                    'name' => mb_convert_case($staff, MB_CASE_TITLE, "UTF-8"),
                    'email' => $this->email,
                    'department_id' => $this->department,
                    'begin' => $formattedBegin,
                    'end' => $formattedEnd,
                    'description' => $this->description,
                    'status' => $status,
                    'bus' => $this->bus,
                    'shift' => $this->shift,
                ]);
            }
        }

        if ($status == 'pending') {
            $dep = Department::find($this->department);
            foreach ($dep->users as $manager) {
                if (!$manager->isActive()) {
                    continue;
                }

                Mail::to($manager->email)->send(new RequestCreated($overtime));
            }
        } else {
            // BoD
            $directors = User::where([
                ['role', 'bod'],
                ['active', true]
            ])->get();
            foreach ($directors as $director) {
                Mail::to($director->email)->send(new RequestCreated($overtime));
            }
        }


        return redirect('thanks');
    }


}
