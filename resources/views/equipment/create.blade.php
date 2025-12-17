@extends('layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4 shadow-sm border-0">
            <h4 class="mb-4 fw-bold">Add New Equipment</h4>

            <form action="{{ route('equipment.store') }}" method="POST">
                @csrf <!-- THIS LINE PREVENTS 'PAGE EXPIRED' ERROR -->
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Item Name</label>
                        <input type="text" name="Name" class="form-control bg-light" placeholder="e.g. Canon Camera" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Category</label>
                        <select name="Category" class="form-select bg-light">
                            <option>IT & Computing</option>
                            <option>Audio/Visual</option>
                            <option>Laboratory</option>
                            <option>Furniture</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Quantity</label>
                        <input type="number" name="Quantity" class="form-control bg-light" value="1">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Condition</label>
                        <select name="Condition" class="form-select bg-light">
                            <option>New</option>
                            <option>Good</option>
                            <option>Fair</option>
                            <option>Needs Repair</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-bold">Description</label>
                        <textarea name="Description" class="form-control bg-light" rows="3"></textarea>
                    </div>
                </div>

                <div class="mt-4">
                    <button class="btn btn-primary">Save Equipment</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-light">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection