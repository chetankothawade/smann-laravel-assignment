<?php

namespace Tests\Feature;

use App\Enums\ShipmentStatus;
use App\Models\Shipment;
use App\Models\StatusLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShipmentTrackingTest extends TestCase
{
    use RefreshDatabase;

    public function test_root_redirects_to_shipments_page(): void
    {
        $this->get('/')
            ->assertRedirect(route('shipments.index'));
    }

    public function test_shipments_page_displays_paginated_shipments(): void
    {
        Shipment::factory()->count(12)->create();

        $response = $this->get(route('shipments.index'));

        $response->assertOk();
        $response->assertViewHas('shipments', fn ($shipments) => $shipments->count() === 10 && $shipments->total() === 12);
    }

    public function test_shipments_page_filters_by_tracking_number(): void
    {
        $matchedShipment = Shipment::factory()->create([
            'tracking_number' => 'TRK-MATCH123',
        ]);
        Shipment::factory()->create([
            'tracking_number' => 'TRK-OTHER999',
        ]);

        $response = $this->get(route('shipments.index', ['search' => 'MATCH']));

        $response->assertOk();
        $response->assertSeeText($matchedShipment->tracking_number);
        $response->assertDontSeeText('TRK-OTHER999');
    }

    public function test_shipment_details_page_displays_full_information_and_timeline(): void
    {
        $shipment = Shipment::factory()->create([
            'status' => ShipmentStatus::InTransit,
        ]);

        StatusLog::factory()->create([
            'shipment_id' => $shipment->id,
            'status' => ShipmentStatus::Pending,
            'location' => 'Mumbai Hub',
            'created_at' => now()->subHours(8),
        ]);
        StatusLog::factory()->create([
            'shipment_id' => $shipment->id,
            'status' => ShipmentStatus::InTransit,
            'location' => 'Pune Dispatch Center',
            'created_at' => now()->subHours(2),
        ]);

        $response = $this->get(route('shipments.show', $shipment));

        $response->assertOk();
        $response->assertSeeText($shipment->sender_name);
        $response->assertSeeText($shipment->receiver_name);
        $response->assertSeeText('Mumbai Hub');
        $response->assertSeeText('Pune Dispatch Center');
        $response->assertSeeText(ShipmentStatus::InTransit->value);
    }
}
