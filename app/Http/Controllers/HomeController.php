<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;



class HomeController extends Controller
{
/**
 * Create a new controller instance.
 *
 * @return void
 */
public function __construct()
{
$this->middleware('auth');
}

/**
 * Show the application dashboard.
 *
 * @return \Illuminate\Contracts\Support\Renderable
 */


public function index() {
$users = User::all();
return view('admin.show', compact('users'));
}

public function home()
{
return view('admin.home');
}


public function create()
{
return view('admin.create');
}



public function show()
{
$users = User::all();
return view('admin.show', compact('users'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'mobile' => 'required|string|max:11',
        'gender' => 'required|string',
        'user_type' => 'required|string',
        'profile_image' => 'nullable|image|max:2048',
    ]);

    $profileImagePath = null;
    if ($request->hasFile('profile_image')) {
        $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
    }


    $defaultPassword = 'ee';

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'gender' => $request->gender,
        'role' => $request->user_type,
        'profile_image' => $profileImagePath,
        'password' => Hash::make($defaultPassword),
    ]);

    return redirect()->route('show-users')->with('success', 'User created successfully!');
}



public function edit($id)
{
$user = User::findOrFail($id);

if ($user->role === 'admin') {
return redirect()->route('edit-users')->with('error', 'Admin users cannot be edited.');
}

return view('admin.edit', compact('user'));
}






public function update(Request $request, $id)
{
$user = User::findOrFail($id);

if ($user->role === 'admin') {
return redirect()->route('admin.show')->with('error', 'Admin users cannot be updated.');
}

$request->validate([
'name' => 'required|string|max:255',
'email' => 'required|email|unique:users,email,' . $id,
'mobile' => 'required|string|max:11',
'gender' => 'required|string',
'user_type' => 'required|string',
'profile_image' => 'nullable|image|max:2048',
'password' => 'nullable|string|min:5|confirmed',
]);

if ($request->hasFile('profile_image')) {
if ($user->profile_image) {
Storage::disk('public')->delete($user->profile_image);
}
$profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
$user->profile_image = $profileImagePath;
}

$user->update([
'name' => $request->name,
'email' => $request->email,
'mobile' => $request->mobile,
'gender' => $request->gender,
'role' => $request->user_type,
]);

if ($request->filled('password')) {
$user->password = Hash::make($request->password);
$user->save();
}

return redirect()->route('show-users')->with('success', 'User updated successfully!');
}









public function destroy($id)
{
$user = User::findOrFail($id);

if ($user->role === 'admin') {
return redirect()->route('show-users')->with('error', 'Admin users cannot be deleted.');
}

$user->delete();

return redirect()->route('show-users')->with('success', 'User deleted successfully!');
}


}
