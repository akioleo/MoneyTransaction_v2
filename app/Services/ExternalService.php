<?php

namespace App\Services;

use App\Constants\Constants;
use Illuminate\Support\Facades\DB;

class ExternalService
{
    public function validateMock($data)
    {

        $auth = curl_init('https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');
        curl_setopt($auth, CURLOPT_RETURNTRANSFER, true);
        $return = json_decode(curl_exec($auth));

        if ($return->message != "Autorizado") {
            $response = Constants::EXTERNAL_TRANSACTION_AUTHORIZATION_ERROR;
            return $response;
        }
        curl_close($auth);

        $notify = curl_init('http://o4d9z.mocklab.io/notify');
        curl_setopt($notify, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($notify));

        if ($result->message != "Success") {
            $response = Constants::EXTERNAL_TRANSACTION_NOTIFICATION_ERROR;
            return $response;
        }
        curl_close($notify);
    }
}
