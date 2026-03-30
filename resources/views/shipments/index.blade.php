<x-layouts.app :title="'Shipments'">
    <section class="d-grid gap-4">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form method="GET" action="{{ route('shipments.index') }}" class="row g-3 align-items-end">
                    <div class="col-md-8">
                        <label for="search" class="form-label fw-semibold">Search by tracking number</label>
                    <input
                        id="search"
                        name="search"
                        type="text"
                        value="{{ $search }}"
                        placeholder="TRK-AB12345"
                        class="form-control form-control-lg"
                    >
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-lg px-4">
                                Search
                            </button>
                            <a href="{{ route('shipments.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">Tracking Number</th>
                            <th class="px-4 py-3">Receiver Name</th>
                            <th class="px-4 py-3">Destination City</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3 text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shipments as $shipment)
                            <tr>
                                <td class="px-4 py-3 fw-semibold">{{ $shipment->tracking_number }}</td>
                                <td class="px-4 py-3">{{ $shipment->receiver_name }}</td>
                                <td class="px-4 py-3">{{ $shipment->destination_city }}</td>
                                <td class="px-4 py-3">
                                    <x-status-badge :status="$shipment->status" />
                                </td>
                                <td class="px-4 py-3">{{ $shipment->shipment_date->format('d M Y') }}</td>
                                <td class="px-4 py-3 text-end">
                                    <a href="{{ route('shipments.show', $shipment) }}" class="btn btn-sm btn-outline-primary">
                                        View details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-5 text-center text-muted">
                                    No shipments matched your search.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-footer bg-white py-3">
                {{ $shipments->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
</x-layouts.app>
