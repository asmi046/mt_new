<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;


class TinkoffPayService {

    protected $notification_url;
    protected $success_url;
    protected $fail_url;

    public function __construct()
    {
        $this->notification_url = (config('app.env') === "local")?config('proxy.test_proxy')."/pay/notification":route('pay.notification');
        $this->success_url = (config('app.env') === "local")?config('proxy.test_proxy')."/pay/success":route('pay.success');
        $this->fail_url = (config('app.env') === "local")?config('proxy.test_proxy')."/pay/fail":route('pay.fail');
    }

    public function gey_payment_link(int $summ, string $order_id, ) {
        $terminal = config('pay.t_terminal');
        $pass = config('pay.t_pass');
        $lnk = config('pay.t_lnk');


        $data = array(
            "TerminalKey" => $terminal,
            "Amount" => $summ * 100,
            "OrderId" =>  $order_id,
            "SuccessURL" => $this->success_url."?uuid=".$order_id,
            "FailURL" => $this->fail_url,
            "NotificationURL" => $this->notification_url,
            "PayType" => 'O',
        );

        $response = Http::acceptJson()->post($lnk, $data);

        return $response->json();
    }
}
