<?php

namespace AlexanderKotov28\TradeApiPrototype\Requests;

use AlexanderKotov28\TradeApiPrototype\Common\Order;
use AlexanderKotov28\TradeApiPrototype\Common\OrderType;
use AlexanderKotov28\TradeApiPrototype\Contracts\Requests\OrderCreateRequest as OrderCreateRequestInterface;
use AlexanderKotov28\TradeApiPrototype\Exceptions\InvalidParameterException;

class OrderCreateRequest extends PrivateRequest implements OrderCreateRequestInterface
{
    protected Order $order;

    public function getPath(): string
    {
        return '/order_create';
    }

    protected function getMethodName(): string
    {
        return 'order_create';
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    protected function getParams(): array
    {
        if (empty($this->order)) {
            throw new InvalidParameterException('Set Order to your Request for create');
        }

        $params = [
            'pair' => $this->order->getPair(),
            'type' => $this->order->getType()->value,
            'action' => $this->order->getAction()->value
        ];

        $params = array_merge($params, match ($this->order->getType()) {
            OrderType::Limit => [
                'amount' => $this->order->getAmount(),
                'price' => $this->order->getPrice()
            ],
            OrderType::StopLimit => [
                'amount' => $this->order->getAmount(),
                'price' => $this->order->getPrice(),
                'stop_price' => $this->order->getStopPrice()
            ],
            default => []
        });

        foreach ($params as $name => $param) {
            if (empty($param)) {
                throw new InvalidParameterException('Parameter "' . $name . '" must be specified for this request');
            }
        }

        // Adding not required params
        if ($this->order->getType() === OrderType::Market) {
            $params = array_merge($params, $this->getAmountOrValue());
        }

        return $params;
    }

    public function setOrder(Order $order): OrderCreateRequest
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Return value or amount for OrderType::Market or throw an exception if specified both
     * @return array
     * @throws InvalidParameterException
     */
    protected function getAmountOrValue(): array
    {
        if ($this->order->getValue() && $this->order->getAmount()) {
            throw new InvalidParameterException('It is possible to specify one of two parameters for creating a market order ("amount" or "value")');
        }

        return $this->order->getValue() ? ['value' => $this->order->getValue()] : ['amount' => $this->order->getAmount()];
    }
}