<?php

namespace AlexanderKotov28\TradeApiPrototype\Contracts\Requests;

use AlexanderKotov28\TradeApiPrototype\Common\OrderAction;

interface MyOrdersRequest extends Request
{
    public function setPair(string $pair);

    public function setAction(OrderAction $action);
}