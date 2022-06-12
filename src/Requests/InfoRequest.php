<?php

namespace AlexanderKotov28\TradeApiPrototype\Requests;


use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\InfoRequest as InfoRequestInterface;

class InfoRequest extends PublicRequest implements InfoRequestInterface
{
    protected ?string $pair = null;

    public function getPath(): string
    {
        return '/info';
    }

    public function getMethod(): string
    {
        return $this->getPair() ? 'POST' : 'GET';
    }

    public function getParams(): array
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