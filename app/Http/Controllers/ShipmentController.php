<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search'));

        $shipments = Shipment::query()
            ->select([
                'id',
                'tracking_number',
                'receiver_name',
                'destination_city',
                'status',
                'shipment_date',
            ])
            ->searchTrackingNumber($search)
            ->latest('shipment_date')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('shipments.index', [
            'shipments' => $shipments,
            'search' => $search,
        ]);
    }

    public function show(Shipment $shipment): View
    {
        $shipment->load([
            'statusLogs' => fn ($query) => $query->orderBy('created_at'),
        ]);

        return view('shipments.show', [
            'shipment' => $shipment,
        ]);
    }
}
