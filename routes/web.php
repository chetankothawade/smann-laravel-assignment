<?php

use App\Http\Controllers\ShipmentController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/shipments');

Route::get('/shipments', [ShipmentController::class, 'index'])->name('shipments.index');
Route::get('/shipments/{shipment}', [ShipmentController::class, 'show'])->name('shipments.show');
