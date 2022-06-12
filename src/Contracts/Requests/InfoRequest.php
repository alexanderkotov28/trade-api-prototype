<?php

namespace AlexanderKotov28\TradeApiPrototype\Contracts\Requests;

interface InfoRequest extends Request
{
    public function setPair(string $pair);

    public function getPair(): ?string;
}