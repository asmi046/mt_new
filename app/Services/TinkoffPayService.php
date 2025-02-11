<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;


class TinkoffPayService {

    protected $notification_url;
    protected $success_url;
    protected $fail_url;

    public function __construct()
    {
        $this->notification_url = (config('app.env') === "local")?"https://08e8-91-218-141-117.ngrok-free.app/pay/notification":route('pay.notification');
        $this->success_url = (config('app.env') === "local")?"https://08e8-91-218-141-117.ngrok-free.app/pay/success":route('pay.success');
        $this->fail_url = (config('app.env') === "local")?"https://08e8-91-218-141-117.ngrok-free.app/pay/fail":route('pay.fail');
    }

    public function gey_payment_link(int $summ, string $order_id, ) {
        $terminal = config('pay.t_terminal');
        $pass = config('pay.t_pass');
        $lnk = config('pay.t_lnk');


        $data = array(
            "TerminalKey" => $terminal,
            "Amount" => $summ * 100,
            "OrderId" =>  $order_id,
            "SuccessURL" => $this->success_url,
            "FailURL" => $this->fail_url,
            "NotificationURL" => $this->notification_url,
            "PayType" => 'O',
        );

        // dd($data);

        $response = Http::acceptJson()->post($lnk, $data);

        return $response->json();
    }
}
