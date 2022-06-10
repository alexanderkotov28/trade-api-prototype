## Usage Example

```php
use AlexanderKotov28\TradeApiPrototype\Client;
use AlexanderKotov28\TradeApiPrototype\Common\Order;
use AlexanderKotov28\TradeApiPrototype\Common\OrderAction;
use AlexanderKotov28\TradeApiPrototype\Common\OrderType;

$client = new Client('API-ID', 'API-SECRET');

$order = (new Order())
        ->setAction(OrderAction::Buy)
        ->setAmount(1)
        ->setType(OrderType::Limit)
        ->setPair('BTC_USD')
        ->setPrice(10.1);

$response = $client->orderCreate()->setOrder($order)->execute();

print_r($response->data);
```