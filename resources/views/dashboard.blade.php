@extends('layout')

@section('content')

<!-- 1. Page Header & Actions -->
<div class="row mb-4 align-items-center">
    <div class="col">
        <h2 class="fw-bold text-dark mb-0">Equipment Catalog</h2>
        <p class="text-muted small">Select the gear you need for your academic work.</p>
    </div>
    <div class="col-auto d-flex gap-2">
        
        <!-- ADMIN ONLY: Add Equipment Button -->
        @if(auth()->user()->role === 'approver')
            <a href="{{ route('equipment.create') }}" class="btn btn-dark shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Add Item
            </a>
        @endif
        
        <!-- Item Counter Badge -->
        <span class="badge bg-white text-dark border shadow-sm p-2 d-flex align-items-center">
            <i class="bi bi-box me-1"></i> {{ $equipment->count() }} Items
        </span>
    </div>
</div>

<!-- 2. Success/Error Messages (Feedback) -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- 3. Equipment Grid -->
<div class="row g-4">
    @foreach($equipment as $item)
    <div class="col-md-6 col-lg-4">
        <div class="card gear-card h-100 border-0 shadow-sm">
            <div class="card-body d-flex flex-column p-4">
                
                <!-- Icon & Status -->
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="icon-square bg-light text-primary rounded-3 p-3">
                        <!-- Dynamic Icon based on Item Name -->
                        @if(stripos($item->Name, 'Camera') !== false) <i class="bi bi-camera fs-4"></i>
                        @elseif(stripos($item->Name, 'Laptop') !== false) <i class="bi bi-laptop fs-4"></i>
                        @elseif(stripos($item->Name, 'Projector') !== false) <i class="bi bi-projector fs-4"></i>
                        @elseif(stripos($item->Name, 'Kit') !== false) <i class="bi bi-briefcase fs-4"></i>
                        @else <i class="bi bi-box-seam fs-4"></i>
                        @endif
                    </div>
                    
                    <!-- Status Badge -->
                    @if($item->AvailabilityStatus == 'Available')
                        <span class="badge bg-success-subtle text-success border border-success-subtle">Available</span>
                    @elseif($item->AvailabilityStatus == 'Pending')
                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle">Pending</span>
                    @else
                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Borrowed</span>
                    @endif
                </div>

                <!-- Item Details -->
                <h5 class="card-title fw-bold text-dark">{{ $item->Name }}</h5>
                
                <!-- Category Tag -->
                @if($item->Category)
                <div class="mb-2">
                    <span class="badge bg-light text-secondary border fw-normal">{{ $item->Category }}</span>
                </div>
                @endif

                <p class="card-text text-muted small flex-grow-1">{{ Str::limit($item->Description, 80) }}</p>
                
                <!-- Card Footer: Actions -->
                <div class="mt-4 pt-3 border-top">
                    
                    <!-- CASE A: USER IS ADMIN (APPROVER) -->
                    @if(auth()->user()->role === 'approver')
                        <div class="d-flex gap-2">
                            <a href="{{ route('equipment.edit', $item->EquipmentID) }}" class="btn btn-outline-secondary btn-sm flex-fill">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            
                            <form action="{{ route('equipment.delete', $item->EquipmentID) }}" method="POST" class="flex-fill" onsubmit="return confirm('Are you sure you want to delete this item? This cannot be undone.');">
                                @csrf
                                <button class="btn btn-outline-danger btn-sm w-100">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>

                    <!-- CASE B: USER IS STUDENT (BORROWER) -->
                    @else
                        @if($item->AvailabilityStatus == 'Available')
                            <a href="{{ route('borrow.form', $item->EquipmentID) }}" class="btn btn-primary w-100 fw-bold">
                                Request Item
                            </a>
                        @else
                            <button class="btn btn-light text-muted w-100" disabled>
                                Currently Unavailable
                            </button>
                        @endif
                    @endif

                </div>

            </div>
        </div>
    </div>
    @endforeach

    <!-- Empty State -->
    @if($equipment->isEmpty())
        <div class="col-12 text-center py-5">
            <div class="text-muted opacity-50">
                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                <p>No equipment currently found in the catalog.</p>
                @if(auth()->user()->role === 'approver')
                    <a href="{{ route('equipment.create') }}" class="btn btn-primary btn-sm mt-2">Add First Item</a>
                @endif
            </div>
        </div>
    @endif
</div>
@endsection