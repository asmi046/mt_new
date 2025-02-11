<?php
    use Illuminate\Support\Facades\Route;

    use App\Http\Controllers\PayOrderController;

    Route::get('/pay/create_pay_order', [PayOrderController::class, "create_pay_order"])->name('create_pay_order');
    Route::get('/pay/get_active_pay_data/{uuid}', [PayOrderController::class, "get_active_pay_data"])->name('get_active_pay_data');
    Route::get('/pay/get_pay_lnk', [PayOrderController::class, "get_pay_lnk"])->name('get_pay_lnk');
    Route::post('/pay/notification', [PayOrderController::class, "notification"])->name('pay.notification');
    Route::get('/pay/success', [PayOrderController::class, "success"])->name('pay.success');
    Route::get('/pay/fail', [PayOrderController::class, "fail"])->name('pay.fail');

    Route::get('/pay/{uuid}', [PayOrderController::class, "show_pay_form"])->name('show_pay_form');

