@extends('layout')

@section('content')

<div class="row mb-4 align-items-center">
    <div class="col">
        <h2 class="fw-bold text-dark mb-0">Equipment Catalog</h2>
        <p class="text-muted small">Select the gear you need for your academic work.</p>
    </div>
    <div class="col-auto">
        <!-- A simple stat for the user -->
        <span class="badge bg-white text-dark border shadow-sm p-2">
            <i class="bi bi-box me-1"></i> {{ $equipment->count() }} Items Listed
        </span>
    </div>
</div>

<!-- Grid Layout for Equipment -->
<div class="row g-4">
    @foreach($equipment as $item)
    <div class="col-md-6 col-lg-4">
        <div class="card gear-card h-100">
            <div class="card-body d-flex flex-column">
                
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="icon-square bg-light text-primary rounded-3 p-3">
                        <!-- Dynamic Icon based on name (Simple logic) -->
                        @if(stripos($item->Name, 'Camera') !== false) <i class="bi bi-camera fs-4"></i>
                        @elseif(stripos($item->Name, 'Laptop') !== false) <i class="bi bi-laptop fs-4"></i>
                        @elseif(stripos($item->Name, 'Projector') !== false) <i class="bi bi-projector fs-4"></i>
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

                <h5 class="card-title fw-bold">{{ $item->Name }}</h5>
                <p class="card-text text-muted small flex-grow-1">{{ $item->Description }}</p>
                
                <div class="mt-3 pt-3 border-top">
                    @if($item->AvailabilityStatus == 'Available')
                        <a href="{{ route('borrow.form', $item->EquipmentID) }}" class="btn btn-primary w-100">
                            Request Item
                        </a>
                    @else
                        <button class="btn btn-light text-muted w-100" disabled>
                            Currently Unavailable
                        </button>
                    @endif
                </div>

            </div>
        </div>
    </div>
    @endforeach

    @if($equipment->isEmpty())
        <div class="col-12 text-center py-5">
            <div class="text-muted">
                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                <p>No equipment currently found in the catalog.</p>
            </div>
        </div>
    @endif
</div>
@endsection