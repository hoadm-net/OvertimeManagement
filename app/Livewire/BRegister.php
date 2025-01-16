<?php

namespace App\Livewire;

use App\Mail\RequestCreated;
use App\Models\Overtime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\WithFileUploads;
use App\Models\Department;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class BRegister extends Component
{
    use WithFileUploads;

    public $file;
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
        'file' => 'required|mimes:xlsx,csv,xls|max:2048',
        'department' => 'required',
        'begin' => 'required',
        'end' => 'required|after:begin',
        'description' => 'nullable',
        'urgent' => 'required',
        'bus' => 'required',
        'shift' => 'nullable'
    ];

    public function render()
    {
        return view('livewire.b-register', [
            'departments' => Department::all()
        ]);
    }

    public function submit() {

        try {
            $this->validate();
            $formattedBegin = Carbon::createFromFormat('d-m-Y H:i', $this->begin)->format('Y-m-d H:i:s');
            $formattedEnd = Carbon::createFromFormat('d-m-Y H:i', $this->end)->format('Y-m-d H:i:s');

            $dep = Department::find($this->department);
            $current_manager = 1;
            if ($this->urgent) {
                $current_manager = $dep->max_level;
            }

            $filePath = $this->file->store('uploads');
            $data = Excel::toArray([], storage_path('app/private/' . $filePath));
            $sheetData = $data[0];

            if (count($sheetData) > 1) {
                for ($i = 1; $i < count($sheetData); $i++) {
                    $user_fullname = trim($sheetData[$i][0]);
                    $user_email = trim($sheetData[$i][1]);

                    $overtime = Overtime::create([
                        'name' => mb_convert_case($user_fullname, MB_CASE_TITLE, "UTF-8"),
                        'email' => $user_email,
                        'department_id' => $this->department,
                        'begin' => $formattedBegin,
                        'end' => $formattedEnd,
                        'description' => $this->description,
                        'status' => 'pending',
                        'bus' => $this->bus,
                        'shift' => $this->shift,
                        'current_manager' => $current_manager
                    ]);
                }

                foreach ($dep->users as $manager) {
                    if (!$manager->isActive()) {
                        continue;
                    }

                    if ($manager->pivot->level == $current_manager) {
                        Mail::to($manager->email)->send(new RequestCreated($overtime));
                    }

                }
            }

        } catch (Exception $e) {
            info($e->getMessage());
        }

        return redirect('thanks');

    }
}
