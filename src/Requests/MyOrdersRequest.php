<?php

namespace AlexanderKotov28\TradeApiPrototype\Requests;

use AlexanderKotov28\TradeApiPrototype\Common\OrderAction;
use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\MyOrdersRequest as MyOrdersRequestInterface;

class MyOrdersRequest extends PrivateRequest implements MyOrdersRequestInterface
{
    protected string $pair;
    protected OrderAction $action;

    public function getMethodName(): string
    {
        return 'my_orders';
    }

    public function getPath(): string
    {
        return '/my_orders';
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getParams(): array
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