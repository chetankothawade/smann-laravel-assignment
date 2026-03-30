<?php

namespace Database\Factories;

use App\Enums\ShipmentStatus;
use App\Models\Shipment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Shipment>
 */
class ShipmentFactory extends Factory
{
    protected $model = Shipment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(ShipmentStatus::cases());
        $shipmentDate = fake()->dateTimeBetween('-30 days', 'now');

        return [
            'tracking_number' => 'TRK-'.Str::upper(fake()->unique()->bothify('??#####')),
            'sender_name' => fake()->name(),
            'sender_address' => fake()->address(),
            'receiver_name' => fake()->name(),
            'receiver_address' => fake()->address(),
            'destination_city' => fake()->city(),
            'status' => $status,
            'shipment_date' => $shipmentDate,
            'created_at' => $shipmentDate,
            'updated_at' => $shipmentDate,
        ];
    }
}
