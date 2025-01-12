@extends('layouts._header')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Guidance History</h1>

    @if($studentSession->isEmpty())
        <p>No guidance records found.</p>
    @else
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">History</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Details</th>
                                <th>Counselor</th>
                                <th>Date</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studentSession as $history)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $history->guidance_type }}</td>
                                    <td>{{ $history->counselor ? $history->counselor->name : 'N/A' }}</td>
                                    <td>{{ $history->created_at->format('M d, Y h:i A') }}</td>
                                    <td>{{ $history->session_notes }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
