<!DOCTYPE html>
<html>
<head>
    <title>Manage Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Back to Dashboard</a>
            <span class="navbar-text text-white">Admin Panel</span>
        </div>
    </nav>

    <div class="container">
        <h3 class="mb-3">Pending Requests</h3>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Borrower</th>
                            <th>Equipment</th>
                            <th>Purpose</th>
                            <th>Return Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingRequests as $req)
                        <tr>
                            <td>{{ $req->borrower->name }}</td>
                            <td>{{ $req->equipment->Name }}</td>
                            <td>{{ $req->Purpose }}</td>
                            <td>{{ $req->DesiredReturnDate }}</td>
                            <td>
                                <!-- Approve Button -->
                                <form action="{{ route('approve', $req->RequestID) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Approve</button>
                                </form>

                                <!-- Decline Button -->
                                <form action="{{ route('decline', $req->RequestID) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Decline</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($pendingRequests->isEmpty())
                    <p class="text-center mt-3 text-muted">No pending requests.</p>
                @endif
            </div>
        </div>
    </div>

</body>
</html>