<?php

namespace AlexanderKotov28\TradeApiPrototype\Requests;

use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\PublicRequest;

class InfoRequest extends PublicRequest
{
    protected ?string $pair = null;

    protected function getPath(): string
    {
        return '/info';
    }

    protected function getMethod(): string
    {
        return $this->getPair() ? 'POST' : 'GET';
    }

    protected function getParams(): array
    {
        return [
            'pair' => $this->getPair()
        ];
    }

    public function setPair(string $pair): InfoRequest
    {
        $this->pair = $pair;
        return $this;
    }

    public function getPair(): ?string
    {
        return $this->pair;
    }
}