<?php

namespace App\Listeners;

use App\Events\PayOrderConfirmed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PayOrderConfirmedSmsSendNotification
{

    /**
     * Handle the event.
     */
    public function handle(PayOrderConfirmed $event): void
    {
        if (isset($event->pay_order->phone)) {
            $sendMsgMain = "Ваши билеты: ".$event->pay_order->ticket_short_lnk;
            file_get_contents("https://" . config('sms.sms_login') . ":" . config('sms.sms_token') . "@gate.smsaero.ru/v2/sms/send?number=". str_replace(['(',')','-',' '], "", $event->pay_order->phone) ."&text=" . $sendMsgMain . "&sign=" . "Mir_Turizma" . "&channel=SERVICE");
        }
    }
}
