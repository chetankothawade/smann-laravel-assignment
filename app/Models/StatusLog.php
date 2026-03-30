<?php

namespace App\Models;

use App\Enums\ShipmentStatus;
use Database\Factories\StatusLogFactory;
use Illuminate\Database\Eloquent\Attributes\Cast;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'shipment_id',
    'status',
    'location',
    'created_at',
])]
class StatusLog extends Model
{
    /** @use HasFactory<StatusLogFactory> */
    use HasFactory;

    public $timestamps = false;

    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }

    #[Cast]
    protected function casts(): array
    {
        return [
            'status' => ShipmentStatus::class,
            'created_at' => 'datetime',
        ];
    }
}
