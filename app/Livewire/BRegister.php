<?php

namespace App\Livewire;

use App\Mail\RequestCreated;
use App\Models\Overtime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\WithFileUploads;
use App\Models\Department;
use Livewire\Component;

class BRegister extends Component
{
    use WithFileUploads;

    public $file;
    public $name;
    public $email;
    public $department;

    protected $rules = [
        'file' => 'required|mimes:xlsx,csv,xls|max:2048',
        'name' => 'required',
        'email' => 'required|email',
        'department' => 'required',
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

            $formattedBegin = Carbon::now()->format('Y-m-d H:i:s');
            $formattedEnd = Carbon::now()->addMinutes(15)->format('Y-m-d H:i:s');
            $dep = Department::find($this->department);

            $filePath = $this->file->storePublicly('uploads', 'public');
            $overtime = Overtime::create([
                'name' => mb_convert_case($this->name, MB_CASE_TITLE, "UTF-8"),
                'email' => $this->email,
                'department_id' => $this->department,
                'begin' => $formattedBegin,
                'end' => $formattedEnd,
                'description' => 'Please check the attached file.',
                'status' => 'pending',
                'bus' => 0,
                'shift' => '_',
                'current_manager' => 1,
                'file_name' => $filePath,
            ]);

            foreach ($dep->users as $manager) {
                if (!$manager->isActive()) {
                    continue;
                }

                if ($manager->pivot->level == 1) {
                    Mail::to($manager->email)->send(new RequestCreated($overtime));
                }
            }

        } catch (Exception $e) {
            info($e->getMessage());
        }

        return redirect('thanks');

    }
}
