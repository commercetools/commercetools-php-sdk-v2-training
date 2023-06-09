<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\Cart\CartUpdateBuilder;
use Commercetools\Api\Models\Order\OrderUpdateBuilder;

include 'clientService.php';


class CheckoutService extends ClientService
{

    public function createCart($draft)
    {
        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->carts()
            ->post($draft)
            ->execute();
    }

    public function getCartById($cartId)
    {
        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->carts()
            ->withId($cartId)
            ->get()
            ->execute();
    }

    public function updateCart($cartId, $actionCollection)
    {
        $cart = $this->getCartById($cartId);

        $apiRoot = $this->getApiClient();

        $updateBuilder = new CartUpdateBuilder();
        $updateBuilder = $updateBuilder
            ->withVersion($cart->getVersion())
            ->withActions($actionCollection)
            ->build();

        return $apiRoot->with()
            ->carts()
            ->withId($cartId)
            ->post($updateBuilder)
            ->execute();
    }

    public function createOrderFromCart($draft)
    {

        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->orders()
            ->post($draft)
            ->execute();
    }

    public function getOrderById($orderId)
    {
        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->orders()
            ->withId($orderId)
            ->get()
            ->execute();
    }

    public function updateOrder($orderId, $actionCollection)
    {
        $order = $this->getOrderById($orderId);

        $apiRoot = $this->getApiClient();
        
        $orderUpdate = (new OrderUpdateBuilder())
            ->withVersion($order->getVersion())
            ->withActions($actionCollection)
            ->build();

        return $apiRoot->with()
            ->orders()
            ->withId($orderId)
            ->post($orderUpdate)
            ->execute();
    }

    public function createPayment($paymentDraft)
    {

        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->payments()
            ->post($paymentDraft)
            ->execute();
    }

    public function customerSignIn($customerSignIn)
    {
        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->login()
            ->post($customerSignIn)
            ->execute();
    }
}
