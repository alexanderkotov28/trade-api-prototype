<?php

namespace AlexanderKotov28\TradeApiPrototype\Requests;

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