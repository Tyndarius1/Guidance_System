@extends('layouts._header')

@section('content')

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('success') }}',
        position: 'top-end',
        toast: true,
        showConfirmButton: false,
        timer: 3000
    });
</script>
@endif

<div class="container">
    <div class="d-flex align-items-center justify-content-between my-4">
        <h1 class="h3 text-gray-900">Records</h1>
        <a href="{{ route('create-record') }}" class="btn btn-primary">Create New Session</a>
    </div>

    <div class="card shadow-lg">
        <div class="card-body">
            @if($sessions->isEmpty())
            <div class="alert alert-info text-center">
                No sessions available.
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Date</th>
                            <th>Counselor</th>
                            <th>Student</th>
                            <th>Guidance Type</th>
                            <th>Course</th>
                            <th>Session Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sessions as $session)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($session->session_date)->format('M d, Y h:i A') }}</td>
                            <td>{{ $session->counselor->name }}</td>
                            <td>{{ $session->student->name }}</td>
                            <td>{{ ucfirst($session->guidance_type) }}</td>
                            <td>{{ $session->course }}</td>
                            <td>
                                <span title="{{ $session->session_notes ?: 'No notes provided' }}">
                                    {{ Str::limit($session->session_notes, 30, '...') }}
                                </span>
                            </td>
                            <td class="d-flex">
                                <a href="{{ route('edit-record', $session->id) }}" class="btn btn-warning btn-sm mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('delete-record') }}" method="POST" id="delete-form-{{ $session->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="session_id" value="{{ $session->id }}">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeletion({{ $session->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    function confirmDeletion(sessionId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            imageUrl: '{{ asset('img/giphy.webp')}}',
            imageWidth: 100,
            imageHeight: 100,
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + sessionId).submit();
            }
        });
    }
</script>
@endsection
