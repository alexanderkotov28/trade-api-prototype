<?php

namespace AlexanderKotov28\TradeApiPrototype\Requests;

use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\PublicRequest;
use AlexanderKotov28\TradeApiPrototype\Exceptions\InvalidParameterException;

class OrdersRequest extends PublicRequest
{
    protected string $pair;

    protected function getPath(): string
    {
        return '/orders';
    }

    protected function getMethod(): string
    {
        return 'GET';
    }

    protected function getParams(): array
    {
        return [
            'pair' => $this->pair ?? throw new InvalidParameterException('Parameter "pair" must be specified for this request')
        ];
    }

    public function setPair(string $pair): OrdersRequest
    {
        $this->pair = $pair;
        return $this;
    }
}