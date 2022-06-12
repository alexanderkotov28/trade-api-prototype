<?php

namespace AlexanderKotov28\TradeApiPrototype;

use AlexanderKotov28\TradeApiPrototype\Exceptions\ApiErrorException;
use AlexanderKotov28\TradeApiPrototype\Exceptions\InvalidParameterException;
use AlexanderKotov28\TradeApiPrototype\Exceptions\InvalidSignatureException;
use AlexanderKotov28\TradeApiPrototype\Exceptions\InvalidTimestampException;
use AlexanderKotov28\TradeApiPrototype\Exceptions\UnexpectedResponseBody;
use JsonException;

class Response implements Contracts\Response
{
    private array $data;

    public function __construct(string $json_data)
    {
        try {
            $this->data = json_decode($json_data, true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            throw new UnexpectedResponseBody();
        }

        $this->checkSuccess();
    }

    private function checkSuccess()
    {
        if (($this->data['success'] ?? false) === false) {
            throw match ($this->data['error']['code']) {
                'INVALID_PARAMETER' => new InvalidParameterException('Invalid request parameter "' . $this->data['error']['parameter'] . '"'),
                'INVALID_SIGNATURE' => new InvalidSignatureException('Invalid signature. Check API-ID, secret key or user settings'),
                'INVALID_TIMESTAMP' => new InvalidTimestampException('Invalid timestamp. Check your server time or the request went to the API server for more than 60 seconds'),
                default => new ApiErrorException($this->data['error']['code'] ?? 'API Error')
            };
        }
    }

    public function getData(): array
    {
        return $this->data ?? [];
    }
}