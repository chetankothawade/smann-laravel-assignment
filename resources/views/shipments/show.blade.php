<x-layouts.app :title="$shipment->tracking_number">
    <div class="row g-4">
        <section class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-start gap-3 border-bottom pb-4">
                    <div>
                            <p class="text-uppercase text-muted small fw-semibold mb-2">Tracking Number</p>
                            <h2 class="h3 fw-bold mb-2">{{ $shipment->tracking_number }}</h2>
                            <p class="mb-0 text-muted">Shipment created on {{ $shipment->shipment_date->format('d M Y') }}</p>
                        </div>
                        <div>
                            <x-status-badge :status="$shipment->status" />
                        </div>
                    </div>

                    <div class="row g-4 mt-1">
                        <div class="col-md-6">
                            <div class="border rounded-4 bg-light h-100 p-4">
                                <p class="text-uppercase text-muted small fw-semibold mb-2">Sender</p>
                                <h3 class="h5 fw-bold">{{ $shipment->sender_name }}</h3>
                                <p class="mb-0 text-secondary" style="white-space: pre-line;">{{ $shipment->sender_address }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-4 bg-light h-100 p-4">
                                <p class="text-uppercase text-muted small fw-semibold mb-2">Receiver</p>
                                <h3 class="h5 fw-bold">{{ $shipment->receiver_name }}</h3>
                                <p class="mb-0 text-secondary" style="white-space: pre-line;">{{ $shipment->receiver_address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <aside class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <p class="text-uppercase text-muted small fw-semibold mb-2">Status Timeline</p>
                            <h3 class="h4 fw-bold mb-0">Shipment progress</h3>
                        </div>
                        <a href="{{ route('shipments.index') }}" class="btn btn-outline-secondary btn-sm">
                    Back to list
                        </a>
                    </div>

                    <div class="mt-4">
                        @forelse ($shipment->statusLogs as $log)
                            <div class="d-flex gap-3 {{ $loop->last ? '' : 'mb-3' }}">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="timeline-marker"></div>
                                    @if (! $loop->last)
                                        <div class="timeline-line"></div>
                                    @endif
                                </div>
                                <div class="pb-2">
                                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                                        <x-status-badge :status="$log->status" />
                                        <span class="fw-semibold">{{ $log->location }}</span>
                                    </div>
                                    <p class="text-muted mb-0">{{ $log->created_at->format('d M Y, h:i A') }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-light border mb-0">
                                No status history is available for this shipment.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </aside>
    </div>
</x-layouts.app>
