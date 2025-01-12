@extends('layouts._header')

@section('content')

@if(session('success') || session('error'))
<script>
    Swal.fire({
        icon: '{{ session('success') ? 'success' : 'error' }}',
        title: '{{ session('success') ? 'Success' : 'Oops...' }}',
        text: '{{ session('success') ?: session('error') }}',
        position: 'top-end',
        toast: true,
        showConfirmButton: false,
        timer: 3000
    });
</script>
@endif



<div class="container-fluid mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">Users List</h6>
            <a href="/create-users" class="btn btn-success btn-sm">+ Add User</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if($users->count() > 1)
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Gender</th>
                            <th>Role</th>
                            <th>Profile</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        @if ($user->id !== Auth::user()->id && $user->role !== 'admin')
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td class="text-truncate">{{ $user->email }}</td>
                            <td>{{ $user->mobile }}</td>
                            <td>{{ ucfirst($user->gender) }}</td>
                            <td>
                                <span class="badge badge-{{ $user->role === 'admin' ? 'danger' : ($user->role === 'counselor' ? 'warning' : 'success') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>
                                @if ($user->profile_image)
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>

                            <td>
                                @if ($user->role !== 'admin')
                                <a href="{{ route('edit-user', $user->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('delete-user', $user->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-user-id="{{ $user->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                @else
                                <span class="text-muted">Not Editable</span>
                                @endif
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-center">No users available.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                imageUrl: '{{ asset('img/giphy.webp') }}',
                imageWidth: 100,
                imageHeight: 100,
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then(result => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });
    });
</script>
@endsection
