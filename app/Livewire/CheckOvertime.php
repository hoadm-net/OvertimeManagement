<?php

namespace App\Livewire;

use App\Mail\AdminApproved;
use App\Mail\RequestApproved;
use App\Mail\RequestCreated;
use App\Mail\RequestRejected;
use App\Models\Log;
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
    public $isProcessing = false;

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
        if ($this->isProcessing) {
            return true;
        } else {
            $this->isProcessing = true;
        }


        $overtime = Overtime::findOrFail($this->ot);
        Log::create([
            'overtime_id' => $this->ot,
            'user_id' => Auth::id(),
            'action' => 'approved',
            'notes' => $this->note,
        ]);

        if ($overtime->current_manager == $overtime->department->max_level) {
            // trùm cuối đã duyệt
            $overtime->status = 'approved';
            $overtime->save();

            // gửi mail xác nhận đã duyệt
            if ($overtime->email) {
                Mail::to($overtime->email)->send(new AdminApproved($overtime));
            }
        } else {
            // chuyển cấp
            $overtime->status = 'processing';
            $overtime->current_manager += 1;
            $overtime->save();

            foreach ($overtime->department->users as $user) {
                if (!$user->isActive()) {
                    continue;
                }

                if ($user->pivot->level == $overtime->current_manager) {
                    Mail::to($user->email)->send(new RequestCreated($overtime));
                }
            }
            if ($overtime->email) {
                Mail::to($overtime->email)->send(new AdminApproved($overtime));
            }

        }

        $this->isProcessing = false;
        return redirect()->route('dashboard');
    }

    public function deny() {
        if ($this->isProcessing) {
            return true;
        } else {
            $this->isProcessing = true;
        }

        $overtime = Overtime::findOrFail($this->ot);
        $overtime->status = 'rejected';
        $overtime->save();

        Log::create([
            'overtime_id' => $this->ot,
            'user_id' => Auth::id(),
            'action' => 'rejected',
            'notes' => $this->note,
        ]);

        if ($overtime->email) {
            Mail::to($overtime->email)->send(new RequestRejected($overtime));
        }

        $this->isProcessing = false;
        return redirect()->route('dashboard');
    }
}
