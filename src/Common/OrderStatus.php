<?php

namespace AlexanderKotov28\TradeApiPrototype\Common;

enum OrderStatus: string
{
    case Success = 'success';
    case Processing = 'processing';
    case Waiting = 'waiting';
    case Canceled = 'canceled';
}