<?php

namespace AlexanderKotov28\TradeApiPrototype\Contracts\Requests;

abstract class PublicRequest extends Request
{
    protected function buildParams(): array
    {
        return $this->getParams();
    }

    protected function getHeaders(): array
    {
        return [];
    }
}