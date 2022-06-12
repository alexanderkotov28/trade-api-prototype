<?php

namespace AlexanderKotov28\TradeApiPrototype\Contracts\Requests;

use AlexanderKotov28\TradeApiPrototype\Common\Order;

interface OrderCreateRequest extends Request
{
    public function setOrder(Order $order);
}