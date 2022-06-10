<?php

namespace AlexanderKotov28\TradeApiPrototype;

class Client
{
    private ?string $api_secret_key;
    private ?string $api_id;
    private $arError = array();

    private ClientInterface $http_client;
    public function __construct(?string $api_id = null, ?string $api_secret_key = null)
    {
        $this->api_id = $api_id;
        $this->api_secret_key = $api_secret_key;
    }

    private function reqeust($req = array())
    {
        $msec = round(microtime(true) * 1000);
        $req['post']['ts'] = $msec;

        $post = json_encode($req['post']);

        $sign = hash_hmac('sha256', $req['method'].$post, $this->api_secret_key);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://payeer.com/api/trade/".$req['method']);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "API-ID: ".$this->api_id,
            "API-SIGN: ".$sign
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        $arResponse = json_decode($response, true);

        if ($arResponse['success'] !== true)
        {
            $this->arError = $arResponse['error'];
            throw new Exception($arResponse['error']['code']);
        }

        return $arResponse;
    }

    public function getError()
    {
        return $this->arError;
    }

    public function info()
    {
        $res = $this->reqeust(array(
            'method' => 'info',
        ));

        return $res;
    }

    public function orders($pair = 'BTC_USDT')
    {
        $res = $this->reqeust(array(
            'method' => 'orders',
            'post' => array(
                'pair' => $pair,
            ),
        ));

        return $res['pairs'];
    }

    public function account()
    {
        $res = $this->reqeust(array(
            'method' => 'account',
        ));

        return $res['balances'];
    }

    public function orderCreate($req = array())
    {
        $res = $this->reqeust(array(
            'method' => 'order_create',
            'post' => $req,
        ));

        return $res;
    }

    public function orderStatus($req = array())
    {
        $res = $this->reqeust(array(
            'method' => 'order_status',
            'post' => $req,
        ));

        return $res['order'];
    }

    public function myOrders($req = array())
    {
        $res = $this->reqeust(array(
            'method' => 'my_orders',
            'post' => $req,
        ));

        return $res['items'];
    }

}
