<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\User;

class SessionController extends Controller
{

    public function index()
    {
        $sessions = Session::with(['counselor', 'student'])->get();

        return view('admin.records', compact('sessions'));
    }


    public function createRecord()
    {
        $counselors = User::where('role', 'counselor')->get();
        $students = User::where('role', 'student')->get();

        return view('admin.create-record', compact('counselors', 'students'));
    }



    public function store(Request $request)
    {

        $validated = $request->validate([
            'counselor_id' => 'required|exists:users,id',
            'student_id' => 'required|exists:users,id',
            'session_date' => 'required|date',
            'course' => 'required|in:BSIT,BEED,BSED-SC,BSED-M',
            'guidance_type' => 'required|in:academic,career,mental_health',
            'session_notes' => 'nullable|string',
        ]);


        Session::create([
            'counselor_id' => $validated['counselor_id'],
            'student_id' => $validated['student_id'],
            'session_date' => $validated['session_date'],
            'course' => $validated['course'],
            'guidance_type' => $validated['guidance_type'],
            'session_notes' => $validated['session_notes'] ?? null,
        ]);


        return redirect()->route('records')->with('success', 'Session created successfully.');
    }


    public function edit($id)
    {
        $session = Session::findOrFail($id);
        $counselors = User::where('role', 'counselor')->get();

        return view('admin.edit-record', compact('session', 'counselors'));
    }




public function update(Request $request, $id)
{
    $session = Session::findOrFail($id);

    $validated = $request->validate([
        'counselor_id' => 'required|exists:users,id',
        'session_date' => 'required|date',
        'course' => 'required|in:BSIT,BEED,BSED-SC,BSED-M',
        'guidance_type' => 'required|in:academic,career,mental_health',
        'session_notes' => 'nullable|string',
    ]);


    $session->update($validated);


    return redirect()->route('records')->with('success', 'Session updated successfully.');
}


  // Delete a session
  public function destroy(Request $request)
  {
      $session = Session::findOrFail($request->session_id);

      $session->delete();

      return redirect()->route('records')->with('success', 'Session deleted successfully.');
  }
}
