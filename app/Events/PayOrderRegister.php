<?php

namespace App\Events;

use App\Models\PayOrder;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PayOrderRegister
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pay_order;

    /**
     * Create a new event instance.
     */
    public function __construct(PayOrder $pay_order)
    {
        $this->pay_order = $pay_order;
    }

}
