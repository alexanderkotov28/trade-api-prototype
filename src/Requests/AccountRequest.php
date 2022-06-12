<?php

namespace AlexanderKotov28\TradeApiPrototype\Requests;

use \AlexanderKotov28\TradeApiPrototype\Contracts\Requests\AccountRequest as AccountRequestInterface;

class AccountRequest extends PrivateRequest implements AccountRequestInterface
{

    public function getPath(): string
    {
        return '/account';
    }

    public function getMethodName(): string
    {
        return 'account';
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getParams(): array
    {
        return [];
    }
}