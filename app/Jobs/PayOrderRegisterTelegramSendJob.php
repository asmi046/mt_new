<?php

namespace App\Jobs;

use App\Models\PayOrder;
use App\Services\TelegramSendServices;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class PayOrderRegisterTelegramSendJob implements ShouldQueue
{
    use Queueable;

    protected $pay;

    /**
     * Create a new job instance.
     */
    public function __construct(PayOrder $pay)
    {
        $this->pay = $pay;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $tg_service = new TelegramSendServices();
        $tg_service->pay_register($this->pay);
    }
}
