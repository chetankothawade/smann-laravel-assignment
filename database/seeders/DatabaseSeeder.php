<?php

namespace Database\Seeders;

use App\Enums\ShipmentStatus;
use App\Models\Shipment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Shipment::factory()
            ->count(24)
            ->create()
            ->each(function (Shipment $shipment): void {
                $timeline = match ($shipment->status) {
                    ShipmentStatus::Pending => [
                        [ShipmentStatus::Pending, 'Order Confirmed', $shipment->shipment_date->copy()->setTime(9, 15)],
                    ],
                    ShipmentStatus::InTransit => [
                        [ShipmentStatus::Pending, 'Origin Warehouse', $shipment->shipment_date->copy()->setTime(8, 30)],
                        [ShipmentStatus::InTransit, 'Regional Transit Hub', $shipment->shipment_date->copy()->addDay()->setTime(14, 10)],
                    ],
                    ShipmentStatus::Delivered => [
                        [ShipmentStatus::Pending, 'Origin Warehouse', $shipment->shipment_date->copy()->setTime(8, 30)],
                        [ShipmentStatus::InTransit, 'Regional Transit Hub', $shipment->shipment_date->copy()->addDay()->setTime(14, 10)],
                        [ShipmentStatus::Delivered, $shipment->destination_city, $shipment->shipment_date->copy()->addDays(2)->setTime(11, 45)],
                    ],
                };

                $shipment->statusLogs()->createMany(
                    array_map(
                        static fn (array $log): array => [
                            'status' => $log[0],
                            'location' => $log[1],
                            'created_at' => $log[2],
                        ],
                        $timeline,
                    ),
                );
            });
    }
}
