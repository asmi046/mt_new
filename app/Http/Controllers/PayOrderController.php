<?php

namespace App\Http\Controllers;

use App\Models\PayOrder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\ClientServices;
use App\Services\TinkoffPayService;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PayOrderRequest;
use App\Http\Requests\ClientOrderRequest;
use App\Jobs\PayOrderRegisterTelegramSendJob;

class PayOrderController extends Controller
{
    public function create_pay_order(PayOrderRequest $request) {
        $data = $request->validated();

        $data['uuid'] = Str::uuid();
        $pay = PayOrder::create($data);

        return [
            'created_at' => $pay->created_at,
            'uuid' => $pay->uuid,
            'pay_url' => config('app.url').'/pay/'.$pay->uuid,
        ];
    }

    public function show_pay_form(string $uuid) {
        $data = PayOrder::where('uuid', $uuid)->firstOrFail();
        return view('pay.index', ['pay_data' => $data]);
    }

    public function get_active_pay_data(string $uuid) {
        $pay = PayOrder::where('status', 'Создан')->where('uuid', $uuid)->first();
        if (!$pay) abort(419, 'Платеж не найден');
        return $pay;
    }

    public function get_pay_lnk(ClientOrderRequest $request, ClientServices $clientServices, TinkoffPayService $tpc) {
        $data = $request->validated();
        $pay = PayOrder::where('status', 'Создан')->where('uuid', $data['uuid'])->first();
        if (!$pay) abort(419, 'Платеж не найден');

        $clientServices->sync_pay_order_clients($pay, $data['clients']);
        $tp = $tpc->gey_payment_link($pay->price, $pay->uuid);

        $pay->payment_url = $tp['PaymentURL'];
        $pay->payment_id = $tp['PaymentId'];
        $pay->status = "Зарегистрирован";
        $pay->save();

        dispatch(new PayOrderRegisterTelegramSendJob($pay));
        return [
            'payment_url' => $tp['PaymentURL']
        ];
    }


    public function success(Request $request) {
        return view('pay.success');
    }

    public function fail(Request $request) {
        return view('pay.fail');
    }

    public function notification(Request $request) {

        $state = $request->input('Status');
        $order = $request->input('OrderId');

        $pay = PayOrder::where('uuid', $order)->first();

        if ($pay) {
            Log::shareContext($request->all());

            if ($pay->status === "Проведен") return [];
            if ($pay->status === "Ошибка") return [];

            if ($state === "AUTHORIZED") {
                $pay->status = "Авторизован";
                Log::alert("pay CONFIRMED");
            }

            if ($state === "CONFIRMED") {
                $pay->status = "Проведен";
                Log::alert("pay AUTHORIZED");
            }

            if ($state === "REJECTED") {
                $pay->status = "Ошибка";
                Log::alert("pay REJECTED");
            }

            $pay->save();
        }


        return [];
    }
}
