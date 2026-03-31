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
        $status = $this->faker->randomElement(ShipmentStatus::cases());
        $shipmentDate = $this->faker->dateTimeBetween('-30 days', 'now');

        return [
            'tracking_number' => 'TRK-' . Str::upper($this->faker->unique()->bothify('??#####')),
            'sender_name' => $this->faker->name(),
            'sender_address' => $this->faker->address(),
            'receiver_name' => $this->faker->name(),
            'receiver_address' => $this->faker->address(),
            'destination_city' => $this->faker->city(),
            'status' => $status,
            'shipment_date' => $shipmentDate,
            'created_at' => $shipmentDate,
            'updated_at' => $shipmentDate,
        ];
    }
}
