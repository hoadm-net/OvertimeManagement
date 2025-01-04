<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Overtime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ApproveOvetimes extends Component
{
    use WithPagination;

    public function render()
    {
        $user = Auth::user(); // User đang đăng nhập

        $overtimes = Overtime::whereHas('department', function ($query) use ($user) {
            $query->whereIn('id', $user->departments->pluck('id')); // Phòng ban user quản lý
        })->whereIn('current_manager', $user->departments->pluck('pivot.level')) // Cấp quản lý
        ->whereIn('status', ['pending', 'processing'])
        ->paginate(10);

        return view('livewire.approve-ovetimes', [
            'overtimes' => $overtimes
        ]);
    }
}
