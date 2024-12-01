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
        \Laravel\Prompts\info(Auth::user()->role);
        if (Auth::user()->role !== 'su' && Auth::user()->role !== 'hr') {
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
