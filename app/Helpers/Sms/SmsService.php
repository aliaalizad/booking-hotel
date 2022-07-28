<?php

namespace App\Helpers\Sms;


use Illuminate\Support\Facades\Http;


class SmsService {

    private $url;
    private $api;
    private $pattern_id;
    private $from_number;
    private $to_number;
    private $data = [];
    private $params = [];



    private function setData() {

        $this->url = config('services.farazsms.url');
        $this->api = config('services.farazsms.api');
        $this->from_number = config('services.farazsms.number');

        $data = [
            "apikey" => $this->api,
            "pid" => $this->pattern_id,
            "fnum" => $this->from_number,
            "tnum" => $this->to_number,
        ];
    
        for ($i=0; $i < count($this->params) ; $i++) { 
            $key = array_keys($this->params)[$i];
            $value = $this->params[$key];
    
            $data[ 'p'. $i + 1 ] = $key;
            $data[ 'v'. $i + 1 ] = $value;
        }

        $this->data = $data;
    }

    private function sendRequest()
    {
        $this->setData();

        return Http::get($this->url, $this->data);
    }

    public function sendCode($to, $code)
    { 
        $this->pattern_id = "8ydu364d37";
        $this->to_number = $to;
        $this->params = [
            "code" => $code,
        ];

        return $this->sendRequest();
    }

}

