@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4 shadow-sm border-0">
            <h4 class="mb-4 fw-bold">Edit Equipment</h4>

            <form action="{{ route('equipment.update', $equipment->EquipmentID) }}" method="POST">
                @csrf <!-- THIS LINE PREVENTS 'PAGE EXPIRED' ERROR -->
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Item Name</label>
                        <input type="text" name="Name" class="form-control bg-light" value="{{ $equipment->Name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Category</label>
                        <input type="text" name="Category" class="form-control bg-light" value="{{ $equipment->Category }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Condition</label>
                        <select name="Condition" class="form-select bg-light">
                            <option {{ $equipment->Condition == 'New' ? 'selected' : '' }}>New</option>
                            <option {{ $equipment->Condition == 'Good' ? 'selected' : '' }}>Good</option>
                            <option {{ $equipment->Condition == 'Fair' ? 'selected' : '' }}>Fair</option>
                            <option {{ $equipment->Condition == 'Needs Repair' ? 'selected' : '' }}>Needs Repair</option>
                        </select>
                    </div>
                     <div class="col-md-6">
                        <label class="form-label small fw-bold">Status</label>
                        <select name="AvailabilityStatus" class="form-select bg-light">
                            <option {{ $equipment->AvailabilityStatus == 'Available' ? 'selected' : '' }}>Available</option>
                            <option {{ $equipment->AvailabilityStatus == 'Borrowed' ? 'selected' : '' }}>Borrowed</option>
                            <option {{ $equipment->AvailabilityStatus == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-bold">Description</label>
                        <textarea name="Description" class="form-control bg-light" rows="3">{{ $equipment->Description }}</textarea>
                    </div>
                </div>

                <div class="mt-4">
                    <button class="btn btn-success">Update Details</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-light">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection