<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Shipment Tracker' }}</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    >
    <style>
        body {
            background-color: #f8f9fa;
        }

        .timeline-marker {
            width: 0.875rem;
            height: 0.875rem;
            border-radius: 9999px;
            background-color: #0d6efd;
            border: 3px solid #cfe2ff;
            margin-top: 0.375rem;
            flex-shrink: 0;
        }

        .timeline-line {
            width: 2px;
            min-height: 2rem;
            background-color: #dee2e6;
            margin-left: 0.4rem;
            margin-top: 0.35rem;
        }
    </style>
</head>
<body class="text-dark">
    <div class="container py-5">
        <header class="bg-white border rounded-3 shadow-sm p-4 mb-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h1 class="h3 fw-bold mb-1">Shipment Tracking</h1>
                    <p class="mb-0 text-muted">Laravel Assessment BY Chetan Kothawade</p>
                </div>
                <nav>
                    <a href="{{ route('shipments.index') }}" class="btn btn-outline-primary fw-semibold">
                        Shipments
                    </a>
                </nav>
            </div>
        </header>

        <main>
            {{ $slot }}
        </main>
    </div>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"
    ></script>
</body>
</html>
