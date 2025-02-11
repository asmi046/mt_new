<?php
namespace App\Services;

use App\Models\Client;
use App\Models\PayOrder;

class ClientServices {

    public function sync_pay_order_clients(PayOrder $pay, array $clients_data) {
        $pay->clients()->where('pay_order_id', $pay->id)->delete();
        foreach ($clients_data as $client) {
            // dd($client);

            $pay->clients()->updateOrCreate(
                $client
            );
        }

    }
}
