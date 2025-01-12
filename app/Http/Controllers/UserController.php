<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{

public function showChangePasswordForm()
{

$user = Auth::user();
if ($user->role !== 'counselor' && $user->role !== 'student') {
return redirect()->route('home')->with('error', 'You are not authorized to change the password.');
}

return view('admin.profile');
}



public function updatePassword(Request $request)
{
$user = Auth::user();


if (!$user instanceof User) {
return back()->with('error', 'User not found.');
}


$request->validate([
'password' => 'required|string|min:5|confirmed',
]);



$user->password = Hash::make($request->password);
$user->save();

return back()->with('success', 'Password changed successfully!');
}

}
