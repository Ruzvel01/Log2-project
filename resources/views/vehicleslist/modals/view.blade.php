<div class="modal fade" id="viewModal{{ $vehicle->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 receipt-card">
            <div class="modal-header border-0 pb-0" style="background: linear-gradient(to right, #7494ec, #5a7bd4);">
                <h5 class="modal-title text-white fw-bold">
                    <i class='bx bxs-file-find me-2'></i>VEHICLE INFO SHEET
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">
                <div class="receipt-body">
                    <div class="text-center mb-3">
                        <small class="text-muted text-uppercase fw-bold tracking-widest">System Record ID: #{{ str_pad($vehicle->id, 5, '0', STR_PAD_LEFT) }}</small>
                        <div class="receipt-divider mt-2"></div>
                    </div>

                    <div class="receipt-item">
                        <span class="label">PLATE NUMBER</span>
                        <span class="dots"></span>
                        <span class="value fw-bold text-primary">{{ $vehicle->plate_no }}</span>
                    </div>

                    <div class="receipt-item">
                        <span class="label">MODEL</span>
                        <span class="dots"></span>
                        <span class="value">{{ $vehicle->model }}</span>
                    </div>

                    <div class="receipt-item">
                        <span class="label">VEHICLE TYPE</span>
                        <span class="dots"></span>
                        <span class="value">{{ $vehicle->type }}</span>
                    </div>

                    <div class="receipt-item">
                        <span class="label">STATUS</span>
                        <span class="dots"></span>
                        <span class="value">
                            <span class="status-dot {{ strtolower($vehicle->status) }}"></span>
                            {{ $vehicle->status }}
                        </span>
                    </div>

                    <div class="receipt-divider my-3"></div>

                    <div class="receipt-item">
                        <span class="label">ENGINE NO.</span>
                        <span class="dots"></span>
                        <span class="value">{{ $vehicle->engine_no ?? 'N/A' }}</span>
                    </div>

                    <div class="receipt-item">
                        <span class="label">CHASSIS NO.</span>
                        <span class="dots"></span>
                        <span class="value">{{ $vehicle->chassis_no ?? 'N/A' }}</span>
                    </div>

                    <div class="receipt-item">
                        <span class="label">FUEL TYPE</span>
                        <span class="dots"></span>
                        <span class="value">{{ $vehicle->fuel_type ?? 'N/A' }}</span>
                    </div>

                    <div class="receipt-item">
                        <span class="label">COLOR</span>
                        <span class="dots"></span>
                        <span class="value">{{ $vehicle->color ?? 'N/A' }}</span>
                    </div>

                    <div class="receipt-divider my-3"></div>

                    <div class="text-center">
                        <p class="small text-muted mb-0 italic">Date Logged: {{ $vehicle->created_at->format('F d, Y - h:i A') }}</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0 bg-light justify-content-between">
                <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Close</button>
                
                @if($vehicle->monitoring_status === 'Not-Submitted')
    <form action="{{ route('vehicles.setAvailable', $vehicle->id) }}" method="POST" class="m-0">
        @csrf
        <button type="submit" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm">
            <i class='bx bx-send me-1'></i> Submit to Monitoring
        </button>
    </form>
@endif

            </div>
        </div>
    </div>
</div>