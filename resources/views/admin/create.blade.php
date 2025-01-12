@extends('layouts._header')

@section('content')

<!-- SweetAlert -->
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'User Created!',
            text: '{{ session('success') }}',
            position: 'top-end',
            toast: true,
            showConfirmButton: false,
            timer: 3000
        });
    </script>
@endif




<div class="container">
<!-- Page Heading -->
<div class="d-flex align-items-center justify-content-center my-4">
<h1 class="h3 text-gray-900">Registration</h1>
</div>

<!-- Form Card -->
<div class="card shadow-sm mx-auto" style="max-width: 800px;">
<div class="card-body">


<form method="POST" action="{{ route('store-users') }}" enctype="multipart/form-data">
@csrf

<!-- Personal Details Section -->
<h4 class="text-gray-900 font-weight-bold mb-4">Personal Details</h4>

<div class="row">

<div class="form-group col-md-6 mb-3">
<label for="name" class="font-weight-bold">Name</label>
<input type="text" class="form-control" id="name" name="name" required placeholder="Enter your name">
</div>

<!-- Email -->
<div class="form-group col-md-6 mb-3">
<label for="email" class="font-weight-bold">Email</label>
<input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
</div>
</div>

<div class="row">
<!-- Mobile Number -->
<div class="form-group col-md-6 mb-3">
<label for="mobile" class="font-weight-bold">Mobile Number</label>
<input type="text" class="form-control" id="mobile" name="mobile" required placeholder="Enter mobile number">
</div>

<!-- Gender -->
<div class="form-group col-md-6 mb-3">
<label for="gender" class="font-weight-bold">Gender</label>
<select class="form-control" id="gender" name="gender" required>
<option value="" disabled selected>Select your gender</option>
<option value="male">Male</option>
<option value="female">Female</option>
<option value="other">Other</option>
</select>
</div>
</div>

<div class="row">
<!-- User Type -->
<div class="form-group col-md-6 mb-3">
<label for="user_type" class="font-weight-bold">User Type</label>
<select class="form-control" id="user_type" name="user_type" required>
    <option value="" disabled selected>Select user type</option>
    <option value="counselor">Counselor</option>
    <option value="student">Student</option>
    <option value="admin">Admin</option>
</select>
</div>
</div>



{{-- <!-- Password -->
<div class="row">
<div class="form-group col-md-6 mb-3">
<label for="password" class="font-weight-bold">Password</label>
<input type="password" class="form-control" id="password" name="password" required placeholder="Enter password">
</div>

<!-- Confirm Password -->
<div class="form-group col-md-6 mb-3">
<label for="password_confirmation" class="font-weight-bold">Confirm Password</label>
<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Confirm password">
</div>
</div> --}}


<!-- Profile Image -->
<div class="text-center my-4">
<label for="profile_image" class="font-weight-bold mb-2 d-block">Profile Image</label>
<input type="file" id="input-file-now" name="profile_image" class="dropify"
data-height="200" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg svg webp" />
</div>

<!-- Submit Button -->
<div class="text-center mt-4">
<button type="submit" class="btn btn-primary btn-lg w-50">Next</button>
</div>
</form>
</div>
</div>
</div>





<script>

// Initialize Dropify
$(document).ready(function() {
$('#input-file-now').dropify();
});

</script>

@endsection

