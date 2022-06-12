<?php

namespace AlexanderKotov28\TradeApiPrototype\Exceptions;

use Exception;

class UnexpectedResponseBody extends Exception
{
    protected $message = 'Response body is incorrect. Expected JSON string.';
}