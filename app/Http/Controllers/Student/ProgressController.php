<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $progress = $user->progress()->with('specialization')->get();

        return view('student.progress.index', compact('progress'));
    }
}
