<?php

namespace AlexanderKotov28\TradeApiPrototype\Common;

enum OrderAction: string
{
    case Buy = 'buy';
    case Sell = 'sell';
}