<?php

namespace App\Livewire;

use App\Mail\RequestApproved;
use App\Mail\RequestCreated;
use App\Models\Overtime;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use LivewireUI\Modal\ModalComponent;

class CheckOvertime extends ModalComponent
{
    public $ot;
    public ?string $note = null;

    public function render()
    {
        $overtime = Overtime::findOrFail($this->ot);
        return view('livewire.check-overtime',
        [
            'overtime' => $overtime,
        ]);
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function approve() {
        $overtime = Overtime::findOrFail($this->ot);
        if (Auth::user()->role == 'manager') {
            $overtime->status = 'manager_approved';
            $overtime->manager_id = Auth::id();

            if ($this->note != null) {
                $overtime->manager_note = $this->note;
            }

            $overtime->manager_approved_at = Carbon::now();
            $overtime->save();

            // gửi 2 cái mails
            if ($overtime->email) {
                Mail::to($overtime->email)->send(new RequestApproved($overtime));
            }

            // gửi mail cho sếp
            $directors = User::where([
                ['role', 'bod'],
                ['active', true]
            ])->get();
            foreach ($directors as $director) {
                Mail::to($director->email)->send(new RequestCreated($overtime));
            }

        } else {
            // Bod
            $overtime->status = 'bod_approved';
            $overtime->manager_id = Auth::id();

            if ($this->note != null) {
                $overtime->bod_note = $this->note;
            }

            $overtime->bod_approved_at = Carbon::now();
            $overtime->save();


            // gửi cái mail cho user, nếu có điền
            if ($overtime->email) {
                Mail::to($overtime->email)->send(new RequestApproved($overtime));
            }
        }

        return redirect()->route('dashboard');
    }

    public function deny() {
        $overtime = Overtime::findOrFail($this->ot);
        if (Auth::user()->role == 'manager') {
            $overtime->status = 'denied';
            $overtime->manager_id = Auth::id();

            if ($this->note != null) {
                $overtime->manager_note = $this->note;
            }

            $overtime->manager_approved_at = Carbon::now();
            $overtime->save();

        } else {
            // Bod
            $overtime->status = 'denied';
            $overtime->manager_id = Auth::id();

            if ($this->note != null) {
                $overtime->bod_note = $this->note;
            }

            $overtime->bod_approved_at = Carbon::now();
            $overtime->save();
        }

        return redirect()->route('dashboard');
    }
}
