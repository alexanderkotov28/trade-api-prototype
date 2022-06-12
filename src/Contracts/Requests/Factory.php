<?php

namespace AlexanderKotov28\TradeApiPrototype\Contracts\Requests;

interface Factory
{
    public function createInfoRequest(): InfoRequest;

    public function createOrdersRequest(): OrdersRequest;

    public function createAccountRequest(): AccountRequest;

    public function createOrderCreateRequest(): OrderCreateRequest;

    public function createOrderStatusRequest(): OrderStatusRequest;

    public function createMyOrdersRequest(): MyOrdersRequest;
}