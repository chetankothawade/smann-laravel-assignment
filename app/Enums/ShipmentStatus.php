<?php

namespace App\Enums;

enum ShipmentStatus: string
{
    case Pending = 'Pending';
    case InTransit = 'In Transit';
    case Delivered = 'Delivered';

    /**
     * @return array<int, string>
     */
    public static function values(): array
    {
        return array_map(
            static fn (self $status): string => $status->value,
            self::cases(),
        );
    }

    public function badgeClasses(): string
    {
        return match ($this) {
            self::Pending => 'bg-amber-100 text-amber-800',
            self::InTransit => 'bg-sky-100 text-sky-800',
            self::Delivered => 'bg-emerald-100 text-emerald-800',
        };
    }
}
