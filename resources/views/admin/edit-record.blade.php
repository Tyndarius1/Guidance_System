@extends('layouts._header')

@section('content')



<div class="container">
    <div class="d-sm-flex align-items-center justify-content-between my-4">
        <h1 class="h3 text-gray-900">Edit Session</h1>
        <a href="{{ route('records') }}" class="btn btn-secondary btn-sm">Back to Records</a>
    </div>

    <div class="card shadow-lg">
        <div class="card-body">
            <!-- Edit Session Form -->
            <form method="POST" action="{{ route('update-record', $session->id) }}">
                @csrf
                @method('PUT')

                <!-- Counselor Dropdown -->
                <div class="form-group">
                    <label for="counselor_id">Counselor</label>
                    <select class="form-control" name="counselor_id" id="counselor_id" required>
                        @foreach($counselors as $counselor)
                            <option value="{{ $counselor->id }}" @if($session->counselor_id == $counselor->id) selected @endif>
                                {{ $counselor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Session Date -->
                <div class="form-group">
                    <label for="session_date">Session Date</label>
                    <input type="datetime-local" class="form-control" name="session_date" id="session_date" value="{{ \Carbon\Carbon::parse($session->session_date)->format('Y-m-d\TH:i') }}" required>
                </div>

                <!-- Course Dropdown -->
                <div class="form-group">
                    <label for="course">Course</label>
                    <select class="form-control" name="course" id="course" required>
                        <option value="BSIT" @if($session->course == 'BSIT') selected @endif>BSIT</option>
                        <option value="BEED" @if($session->course == 'BEED') selected @endif>BEED</option>
                        <option value="BSED-SC" @if($session->course == 'BSED-SC') selected @endif>BSED-SC</option>
                        <option value="BSED-M" @if($session->course == 'BSED-M') selected @endif>BSED-M</option>
                    </select>
                </div>

                <!-- Guidance Type Dropdown -->
                <div class="form-group">
                    <label for="guidance_type">Guidance Type</label>
                    <select class="form-control" name="guidance_type" id="guidance_type" required>
                        <option value="academic" @if($session->guidance_type == 'academic') selected @endif>Academic</option>
                        <option value="career" @if($session->guidance_type == 'career') selected @endif>Career</option>
                        <option value="mental_health" @if($session->guidance_type == 'mental_health') selected @endif>Mental Health</option>
                    </select>
                </div>

                <!-- Session Notes -->
                <div class="form-group">
                    <label for="session_notes">Session Notes</label>
                    <textarea class="form-control" name="session_notes" id="session_notes">{{ $session->session_notes }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update Session</button>
            </form>

        </div>
    </div>
</div>


@endsection
