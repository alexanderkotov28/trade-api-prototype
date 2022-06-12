<?php

namespace AlexanderKotov28\TradeApiPrototype\Requests;

use AlexanderKotov28\TradeApiPrototype\Common\Order;
use AlexanderKotov28\TradeApiPrototype\Common\OrderAction;
use AlexanderKotov28\TradeApiPrototype\Common\OrderType;
use AlexanderKotov28\TradeApiPrototype\Exceptions\InvalidParameterException;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class OrderCreateRequestTest extends TestCase
{

    protected OrderCreateRequest $request;

    protected function setUp(): void
    {
        $this->request = new OrderCreateRequest(\Mockery::mock(Client::class));
    }

    public function testGetPath()
    {
        $this->assertEquals('/order_create', $this->request->getPath());
    }

    public function testGetMethod()
    {
        $this->assertEquals('POST', $this->request->getMethod());
    }


    /**
     * @dataProvider invalidParametersProvider
     */
    public function testGetParamsExceptions(Order $order)
    {
        $this->request->setOrder($order);
        $this->expectException(InvalidParameterException::class);
        $this->request->getParams();
    }

    public function testGetParamsWithoutOrderException()
    {
        $this->expectException(InvalidParameterException::class);
        $this->request->getParams();
    }

    public function testGetParams()
    {
        // OrderType::Limit
        $this->request->setOrder((new Order())
            ->setPair('BTC_USD')
            ->setType(OrderType::Limit)
            ->setAction(OrderAction::Buy)
            ->setAmount(1)
            ->setPrice(10.1));

        $this->assertEquals([
            'pair' => 'BTC_USD',
            'type' => OrderType::Limit->value,
            'action' => OrderAction::Buy->value,
            'amount' => 1,
            'price' => 10.1
        ],
            $this->request->getParams()
        );

        // OrderType::Market
        $this->request->setOrder((new Order())
            ->setPair('BTC_USD')
            ->setType(OrderType::Market)
            ->setAction(OrderAction::Sell)
            ->setAmount(1));
        $this->assertEquals([
            'pair' => 'BTC_USD',
            'type' => OrderType::Market->value,
            'action' => OrderAction::Sell->value,
            'amount' => 1
        ],
            $this->request->getParams()
        );

        $this->request->setOrder((new Order())
            ->setPair('BTC_USD')
            ->setType(OrderType::Market)
            ->setAction(OrderAction::Sell)
            ->setValue(1));
        $this->assertEquals([
            'pair' => 'BTC_USD',
            'type' => OrderType::Market->value,
            'action' => OrderAction::Sell->value,
            'value' => 1
        ],
            $this->request->getParams()
        );

        // OrderType::StopLimit
        $this->request->setOrder((new Order())
            ->setPair('BTC_USD')
            ->setType(OrderType::StopLimit)
            ->setAction(OrderAction::Buy)
            ->setAmount(1)
            ->setPrice(10.1)
            ->setStopPrice(10.2));
        $this->assertEquals([
            'pair' => 'BTC_USD',
            'type' => OrderType::StopLimit->value,
            'action' => OrderAction::Buy->value,
            'amount' => 1,
            'price' => 10.1,
            'stop_price' => 10.2
        ],
            $this->request->getParams()
        );
    }

    public function testGetMethodName()
    {
        $this->assertEquals('order_create', $this->request->getMethodName());
    }

    public function testSetOrder()
    {
        $order = \Mockery::mock(Order::class);
        $this->request->setOrder($order);
        $this->assertEquals($order, $this->request->getOrder());
    }

    public function invalidParametersProvider()
    {
        $orders = [];

        $params = [
            OrderType::Market->value => [
                'pair' => fn(Order $order) => $order->setPair('test'),
                'action' => fn(Order $order) => $order->setAction(OrderAction::Buy)
            ],
            OrderType::StopLimit->value => [],
            OrderType::Limit->value => []
        ];


        $params[OrderType::Limit->value] = array_merge($params[OrderType::Market->value], [
            'amount' => fn(Order $order) => $order->setAmount(2),
            'price' => fn(Order $order) => $order->setPrice(2.2)
        ]);

        $params[OrderType::StopLimit->value] = array_merge($params[OrderType::Limit->value], [
            'stop_price' => fn(Order $order) => $order->setStopPrice(2.23),
        ]);

        foreach (OrderType::cases() as $type) {
            foreach ($params[$type->value] as $exclude_key => $closure) {
                $order = new Order();
                $order->setType($type);

                foreach (array_keys($params[$type->value]) as $key) {
                    if ($key !== $exclude_key) {
                        $orders[] = [clone $closure($order)];
                    }
                }
            }
        }

        $orders[] = [(new Order())->setType(OrderType::Limit)
            ->setAmount(2)
            ->setValue(22)];

        return $orders;
    }
}
