<?php

namespace AlexanderKotov28\TradeApiPrototype\Common;

enum OrderType: string
{
    case Limit = 'limit';
    case Market = 'market';
    case StopLimit = 'stop_limit';
}