<!DOCTYPE html>
<html>
<head>
    <title>Active Loans & Returns</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Back to Dashboard</a>
            <span class="navbar-text text-white">Return Management</span>
        </div>
    </nav>

    <div class="container">
        <h3>Active Loans</h3>
        <p class="text-muted">Process returns and apply penalties here.</p>

        <div class="card shadow">
            <div class="card-body">
                <table class="table align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Borrower</th>
                            <th>Equipment</th>
                            <th>Due Date</th>
                            <th>Penalty (Optional)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeLoans as $loan)
                        <!-- Highlight Row if Overdue -->
                        <tr class="{{ $loan->DesiredReturnDate < now()->format('Y-m-d') ? 'table-danger' : '' }}">
                            
                            <td>{{ $loan->borrower->name }}</td>
                            <td>{{ $loan->equipment->Name }}</td>
                            <td>
                                {{ $loan->DesiredReturnDate }}
                                @if($loan->DesiredReturnDate < now()->format('Y-m-d'))
                                    <span class="badge bg-danger">OVERDUE</span>
                                @endif
                            </td>
                            
                            <!-- Form for Return & Penalty -->
                            <form action="{{ route('process.return', $loan->RequestID) }}" method="POST">
                                @csrf
                                <td>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">₱</span>
                                        <input type="number" name="penalty_amount" class="form-control" placeholder="0.00">
                                        <input type="text" name="penalty_reason" class="form-control" placeholder="Reason (e.g. Late)">
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Mark Returned</button>
                                </td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($activeLoans->isEmpty())
                    <p class="text-center mt-3 text-muted">No equipment is currently being borrowed.</p>
                @endif
            </div>
        </div>
    </div>

</body>
</html>