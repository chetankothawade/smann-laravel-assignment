<?php

namespace Database\Factories;

use App\Enums\ShipmentStatus;
use App\Models\Shipment;
use App\Models\StatusLog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<StatusLog>
 */
class StatusLogFactory extends Factory
{
    protected $model = StatusLog::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shipment_id' => Shipment::factory(),
            'status' => $this->faker->randomElement(ShipmentStatus::cases()),
            'location' => $this->faker->city(),
            'created_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
