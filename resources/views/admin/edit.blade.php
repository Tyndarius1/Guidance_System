@extends('layouts._header')

@section('content')
<div class="container">
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-center my-4">
        <h1 class="h3 text-gray-900">Edit User</h1>
    </div>

    <!-- Form Card -->
    <div class="card shadow-sm mx-auto" style="max-width: 800px;">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success text-center mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('update-user', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Use PUT method for updates -->

                <!-- Personal Details Section -->
                <h4 class="text-gray-900 font-weight-bold mb-4">Personal Details</h4>

                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="name" class="font-weight-bold">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="email" class="font-weight-bold">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="mobile" class="font-weight-bold">Mobile</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $user->mobile }}" required>
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="gender" class="font-weight-bold">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="user_type" class="font-weight-bold">User Type</label>
                        <select class="form-control" id="user_type" name="user_type" required>
                            <option value="counselor" {{ $user->role == 'counselor' ? 'selected' : '' }}>Counselor</option>
                            <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
                    <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                </div>

                <!-- Profile Image -->
                <div class="text-center my-4">
                    <label for="profile_image" class="font-weight-bold mb-2 d-block">Profile Image</label>
                    @if ($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image"
                             style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;" class="mb-3">
                    @else
                        <p class="text-muted">No Profile Image</p>
                    @endif
                    <input type="file" id="input-file-now" name="profile_image" class="dropify"
                           data-height="200" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg svg webp">
                </div>



                <!-- Submit Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg w-50">Update User</button>
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
