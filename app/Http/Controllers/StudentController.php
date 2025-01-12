<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index() {

        return view("admin.history");
    }



    public function showHistory()
{

    $studentId = Auth::id();
    $studentSession = Session::where('student_id', $studentId)
        ->with(['counselor'])
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.history', compact('studentSession'));
}
}
