<?php

namespace AlexanderKotov28\TradeApiPrototype\Requests;

use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\PrivateRequest;
use AlexanderKotov28\TradeApiPrototype\Exceptions\InvalidParameterException;

class OrderStatusRequest extends PrivateRequest
{

    protected int $order_id;

    protected function getMethodName(): string
    {
        return 'order_status';
    }

    protected function getPath(): string
    {
        return '/order_status';
    }

    protected function getMethod(): string
    {
        return 'POST';
    }

    protected function getParams(): array
    {
        return [
            'order_id' => $this->order_id ?? throw new InvalidParameterException('Parameter "order_id" must be specified for this request')
        ];
    }

    public function setOrderId(int $order_id): OrderStatusRequest
    {
        $this->order_id = $order_id;
        return $this;
    }
}