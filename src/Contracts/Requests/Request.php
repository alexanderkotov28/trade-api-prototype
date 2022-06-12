<?php

namespace AlexanderKotov28\TradeApiPrototype\Contracts\Requests;

use AlexanderKotov28\TradeApiPrototype\Contracts\Response;

interface Request
{
    public function execute(): Response;
}