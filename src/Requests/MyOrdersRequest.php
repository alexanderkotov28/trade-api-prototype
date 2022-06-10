<?php

namespace AlexanderKotov28\TradeApiPrototype\Requests;

use AlexanderKotov28\TradeApiPrototype\Common\OrderAction;
use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\PrivateRequest;

class MyOrdersRequest extends PrivateRequest
{
    protected string $pair;
    protected OrderAction $action;

    protected function getMethodName(): string
    {
        return 'my_orders';
    }

    protected function getPath(): string
    {
        return '/my_orders';
    }

    protected function getMethod(): string
    {
        return 'POST';
    }

    protected function getParams(): array
    {
        return [
            'action' => $this->action->value ?? null,
            'pair' => $this->pair ?? null
        ];
    }

    public function setPair(string $pair): MyOrdersRequest
    {
        $this->pair = $pair;
        return $this;
    }

    public function setAction(OrderAction $action): MyOrdersRequest
    {
        $this->action = $action;
        return $this;
    }
}