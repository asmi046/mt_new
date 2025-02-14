<?php

namespace App\Listeners;

use App\Events\PayOrderRegister;
use App\Services\TelegramSendServices;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PayOrderRegisterTgSendNotification implements ShouldQueue
{


    /**
     * Handle the event.
     */
    public function handle(PayOrderRegister $event): void
    {
        $tg_service = new TelegramSendServices();
        $tg_service->pay_register($event->pay_order);
    }
}
