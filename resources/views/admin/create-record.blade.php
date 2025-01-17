@extends('layouts._header')

@section('content')



<div class="container">
    <div class="d-flex align-items-center justify-content-between my-4">
        <h1 class="h3 text-gray-900">Create Record</h1>
        <a href="{{ route('records') }}" class="btn btn-primary">Back to Sessions</a>
    </div>

    @if($counselors->isEmpty() || $students->isEmpty())
    <div class="alert alert-warning">
        @if($counselors->isEmpty() && $students->isEmpty())
            Ensure at least <strong>one student</strong> and <strong>one counselor</strong> exist to proceed.
        @elseif($counselors->isEmpty())
            Ensure at least <strong>one counselor</strong> exists to proceed.
        @elseif($students->isEmpty())
            Ensure at least <strong>one student</strong> exists to proceed.
        @endif
    </div>
    @endif



    <div class="card shadow-sm mx-auto" style="max-width: 800px;">
        <div class="card-body">
            <form method="POST" action="{{ route('store') }}">
                @csrf

                <table class="table table-borderless">
                    <tbody>
                        <!-- Counselor -->
                        <tr>
                            <td class="font-weight-bold align-middle" style="width: 25%;">Counselor</td>
                            <td>
                                <select id="counselor_id" name="counselor_id" class="form-control" required {{ $counselors->isEmpty() ? 'disabled' : '' }}>
                                    <option value="" disabled selected>Select a counselor</option>
                                    @foreach($counselors as $counselor)
                                        <option value="{{ $counselor->id }}">{{ $counselor->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <!-- Student -->
                        <tr>
                            <td class="font-weight-bold align-middle">Student</td>
                            <td>
                                <select id="student_id" name="student_id" class="form-control" required {{ $students->isEmpty() ? 'disabled' : '' }}>
                                    <option value="" disabled selected>Select a student</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                        <!-- Session Date -->
                        <tr>
                            <td class="font-weight-bold align-middle">Session Date</td>
                            <td>
                                <input type="datetime-local" id="session_date" name="session_date" class="form-control" required>
                            </td>
                        </tr>

                        <!-- Course -->
                        <tr>
                            <td class="font-weight-bold align-middle">Course</td>
                            <td>
                                <select id="course" name="course" class="form-control" required>
                                    <option value="" disabled selected>Select course</option>
                                    <option value="BSIT">BSIT</option>
                                    <option value="BEED">BEED</option>
                                    <option value="BSED-SC">BSED-SC</option>
                                    <option value="BSED-M">BSED-M</option>
                                </select>
                            </td>
                        </tr>

                        <!-- Type of Guidance -->
                        <tr>
                            <td class="font-weight-bold align-middle">Type of Guidance</td>
                            <td>
                                <select id="guidance_type" name="guidance_type" class="form-control" required>
                                    <option value="" disabled selected>Select type of guidance</option>
                                    <option value="academic">Academic</option>
                                    <option value="career">Career</option>
                                    <option value="mental_health">Mental Health</option>
                                </select>
                            </td>
                        </tr>

                        <!-- Session Notes -->
                        <tr>
                            <td class="font-weight-bold align-middle">Session Notes</td>
                            <td>
                                <textarea id="session_notes" name="session_notes" class="form-control" rows="6" style="resize: vertical; max-height: 200px; overflow-y: auto;" placeholder="Enter any key points or notes taken during the session"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Submit Button -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg" {{ $counselors->isEmpty() || $students->isEmpty() ? 'disabled' : '' }}>Create Session</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger mt-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection
