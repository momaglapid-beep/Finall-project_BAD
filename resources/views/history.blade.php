<!DOCTYPE html>
<html>
<head>
    <title>System History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Back to Dashboard</a>
            <span class="navbar-text text-white">System Reports</span>
        </div>
    </nav>

    <div class="container">
        
        <!-- Transaction History -->
        <h4 class="mb-3">Past Transactions</h4>
        <div class="card shadow mb-5">
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Borrower</th>
                            <th>Equipment</th>
                            <th>Status</th>
                            <th>Date Borrowed</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($history as $h)
                        <tr>
                            <td>{{ $h->borrower->name }}</td>
                            <td>{{ $h->equipment->Name }}</td>
                            <td>
                                <span class="badge {{ $h->Status == 'Returned' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $h->Status }}
                                </span>
                            </td>
                            <td>{{ $h->RequestDate }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Penalty Log -->
        <h4 class="mb-3 text-danger">Penalty Log</h4>
        <div class="card shadow border-danger">
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Amount</th>
                            <th>Reason</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penalties as $p)
                        <tr>
                            <td>{{ $p->request->borrower->name }}</td>
                            <td>₱{{ number_format($p->Amount, 2) }}</td>
                            <td>{{ $p->Reason }}</td>
                            <td>{{ $p->DateIssued }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($penalties->isEmpty())
                    <p class="text-muted">No penalties recorded.</p>
                @endif
            </div>
        </div>

    </div>

</body>
</html>