<?php

namespace App\Models;

use App\Enums\ShipmentStatus;
use Database\Factories\ShipmentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'tracking_number',
    'sender_name',
    'sender_address',
    'receiver_name',
    'receiver_address',
    'destination_city',
    'status',
    'shipment_date',
])]
class Shipment extends Model
{
    /** @use HasFactory<ShipmentFactory> */
    use HasFactory;

    public function statusLogs(): HasMany
    {
        return $this->hasMany(StatusLog::class)->latest();
    }

    public function scopeSearchTrackingNumber(Builder $query, ?string $trackingNumber): Builder
    {
        if (blank($trackingNumber)) {
            return $query;
        }

        return $query->where('tracking_number', 'like', '%'.$trackingNumber.'%');
    }

    protected function casts(): array
    {
        return [
            'status' => ShipmentStatus::class,
            'shipment_date' => 'date',
        ];
    }
}
