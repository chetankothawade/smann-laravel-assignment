@props(['status'])

@php
    $badgeClass = match ($status->value) {
        'Pending' => 'text-bg-warning',
        'In Transit' => 'text-bg-primary',
        'Delivered' => 'text-bg-success',
        default => 'text-bg-secondary',
    };
@endphp

<span class="badge {{ $badgeClass }}">
    {{ $status->value }}
</span>
