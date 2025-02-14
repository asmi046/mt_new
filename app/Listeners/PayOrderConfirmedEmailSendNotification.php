<?php

namespace App\Listeners;

use App\Events\PayOrderConfirmed;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClienPaySuccessMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PayOrderConfirmedEmailSendNotification implements ShouldQueue
{

    /**
     * Handle the event.
     */
    public function handle(PayOrderConfirmed $event): void
    {
        if (isset($event->pay_order->email)) {
            Mail::to($event->pay_order->email)->send(new ClienPaySuccessMail($event->pay_order));
        }
    }
}
