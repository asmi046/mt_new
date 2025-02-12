<?php
    use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\TicketController;

    Route::get('/ticket/{uuid}', [TicketController::class, "show_ticket"])->name('show_ticket');

