<?php

namespace AlexanderKotov28\TradeApiPrototype\Requests;

abstract class PublicRequest extends Request
{
    public function buildParams(): array
    {
        return $this->getParams();
    }

    public function getHeaders(): array
    {
        return [];
    }
}