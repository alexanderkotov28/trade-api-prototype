<?php

namespace AlexanderKotov28\TradeApiPrototype\Common;

class Order
{
    protected string $pair;
    protected OrderType $type;
    protected OrderAction $action;
    protected int $amount;
    protected float $price;
    protected int $value;
    protected float $stop_price;

    public function setPair(string $pair): Order
    {
        $this->pair = $pair;
        return $this;
    }

    public function getPair(): ?string
    {
        return $this->pair ?? null;
    }

    public function setType(OrderType $type): Order
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): ?OrderType
    {
        return $this->type ?? null;
    }

    public function setAction(OrderAction $action): Order
    {
        $this->action = $action;
        return $this;
    }

    public function getAction(): ?OrderAction
    {
        return $this->action ?? null;
    }

    public function setAmount(int $amount): Order
    {
        $this->amount = $amount;
        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount ?? null;
    }

    public function setPrice(float $price): Order
    {
        $this->price = $price;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price ?? null;
    }

    public function setStopPrice(float $stop_price): Order
    {
        $this->stop_price = $stop_price;
        return $this;
    }

    public function getStopPrice(): ?float
    {
        return $this->stop_price ?? null;
    }

    public function setValue(int $value): Order
    {
        $this->value = $value;
        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value ?? null;
    }
}