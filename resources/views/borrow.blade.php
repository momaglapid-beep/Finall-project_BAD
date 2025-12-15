@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card p-4">
            <div class="d-flex align-items-center mb-4 border-bottom pb-3">
                <div class="bg-light p-3 rounded-circle me-3 text-primary">
                    <i class="bi bi-bag-plus fs-4"></i>
                </div>
                <div>
                    <h5 class="mb-0 fw-bold">New Request</h5>
                    <small class="text-muted">{{ $equipment->Name }}</small>
                </div>
            </div>

            <form action="{{ route('borrow.submit', $equipment->EquipmentID) }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-bold small">Why do you need this?</label>
                    <textarea name="purpose" class="form-control bg-light border-0" rows="3" placeholder="e.g. For Thesis Project in Lab 3..." required></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold small">When will you return it?</label>
                    <input type="date" name="return_date" class="form-control bg-light border-0" required>
                    <div class="form-text">Please adhere to the return date to avoid fines.</div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Confirm Request</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-light text-muted">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection