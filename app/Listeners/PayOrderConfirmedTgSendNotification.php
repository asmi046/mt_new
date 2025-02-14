<?php

namespace App\Listeners;

use App\Events\PayOrderConfirmed;
use App\Services\TelegramSendServices;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PayOrderConfirmedTgSendNotification implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(PayOrderConfirmed $event): void
    {
        $tg_service = new TelegramSendServices();
        $tg_service->pay_confirmed($event->pay_order);
    }
}
