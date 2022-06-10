<?php

namespace AlexanderKotov28\TradeApiPrototype;

use AlexanderKotov28\TradeApiPrototype\Contracts\RequestFactory as RequestFactoryInterface;
use AlexanderKotov28\TradeApiPrototype\Requests\AccountRequest;
use AlexanderKotov28\TradeApiPrototype\Requests\InfoRequest;
use AlexanderKotov28\TradeApiPrototype\Requests\OrdersRequest;

class Client
{
    private $arError = array();

    private RequestFactoryInterface $request_factory;

    public function __construct(?string $api_id = null, ?string $api_secret_key = null)
    {
        $this->request_factory = new RequestFactory($api_id, $api_secret_key, new \GuzzleHttp\Client());
    }

    /**
     * @param $req
     * @return mixed
     * @deprecated This method will be removed after HttpClient implementation
     */
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

    public function info(): InfoRequest
    {
        return $this->request_factory->createInfoRequest();
    }

    public function orders(): OrdersRequest
    {
        return $this->request_factory->createOrdersRequest();
    }

    public function account(): AccountRequest
    {
        return $this->request_factory->createAccountRequest();
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
