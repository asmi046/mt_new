<?php
namespace App\Services;

use App\Models\Client;
use App\Models\PayOrder;
use Illuminate\Support\Facades\Log;



class VkServices {

    public function get_short_lnk(PayOrder $pay) {
        // if ( $pay->status !== "Проведен" ) return null;

        $large_url = (config('app.url') === "http://127.0.0.1:8001")?config('proxy.test_proxy')."/ticket/".$pay->uuid:route('show_ticket', ['uuid' => $pay->uuid]);

        $query = file_get_contents("https://api.vk.com/method/utils.getShortLink?url=".urlencode( $large_url )."&private=0&access_token=".config('vk.vk_service_id')."&v=5.199");
        $result = json_decode($query,true);
        return (!isset($result['error']['error_code']))?$result['response']['short_url']:null;
    }
}
