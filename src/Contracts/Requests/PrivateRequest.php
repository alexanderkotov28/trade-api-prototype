<?php

namespace AlexanderKotov28\TradeApiPrototype\Contracts\Requests;

abstract class PrivateRequest extends Request
{
    private string $api_id;
    private string $api_secret_key;

    abstract protected function getMethodName(): string;

    public function setApiId(string $api_id): static
    {
        $this->api_id = $api_id;
        return $this;
    }

    public function setApiSecretKey(string $api_secret_key): static
    {
        $this->api_secret_key = $api_secret_key;
        return $this;
    }

    protected function buildParams(): array
    {
        return array_merge($this->getParams(), [
            'ts' => round(microtime(true) * 1000)
        ]);
    }

    protected function getHeaders(): array
    {
        return [
            'API-ID' => $this->api_id,
            'API-SIGN' => $this->getSign()
        ];
    }

    protected function getSign(): string
    {
        return hash_hmac('sha256', $this->getMethodName() . json_encode($this->buildParams()), $this->api_secret_key);
    }
}