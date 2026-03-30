<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Shipment Tracker' }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-900">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
        <header class="mb-8 flex flex-col gap-4 rounded-3xl bg-slate-900 px-6 py-8 text-white shadow-xl sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.3em] text-sky-300">Shipment Tracking</p>
                <h1 class="mt-2 text-3xl font-semibold">Operations Dashboard</h1>
                <p class="mt-2 max-w-2xl text-sm text-slate-300">
                    Track consignments, review delivery progress, and inspect status history from a server-rendered Laravel application.
                </p>
            </div>
            <nav class="flex gap-3 text-sm font-medium">
                <a href="{{ route('shipments.index') }}" class="rounded-full bg-white/10 px-4 py-2 text-white transition hover:bg-white/20">
                    Shipments
                </a>
            </nav>
        </header>

        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>
