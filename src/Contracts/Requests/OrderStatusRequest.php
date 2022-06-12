<?php

namespace AlexanderKotov28\TradeApiPrototype\Contracts\Requests;

interface OrderStatusRequest extends Request
{
    public function setOrderId(int $order_id);
}