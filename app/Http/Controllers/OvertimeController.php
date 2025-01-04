<?php

namespace App\Http\Controllers;

use App\Models\Overtime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OvertimeController extends Controller
{
    public function view(string $id): View
    {
        if (Auth::user()->isAdmin() && Auth::user()->isHR()) {
            abort(403);
        }

        return view('view-overtime', [
            'overtime' => Overtime::findOrFail($id)
        ]);
    }

    public function show(string $id): View
    {
        return view('show-overtime', [
            'overtime' => Overtime::findOrFail($id)
        ]);
    }
}
