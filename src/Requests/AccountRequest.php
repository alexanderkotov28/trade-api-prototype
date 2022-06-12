<?php

namespace AlexanderKotov28\TradeApiPrototype\Requests;

use \AlexanderKotov28\TradeApiPrototype\Contracts\Requests\AccountRequest as AccountRequestInterface;

class AccountRequest extends PrivateRequest implements AccountRequestInterface
{

    protected function getPath(): string
    {
        return '/account';
    }

    protected function getMethodName(): string
    {
        return 'account';
    }

    protected function getMethod(): string
    {
        return 'POST';
    }

    protected function getParams(): array
    {
        return [];
    }
}