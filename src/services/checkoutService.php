<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\Cart\CartUpdateBuilder;
use Commercetools\Api\Models\Order\OrderUpdateBuilder;

include 'clientService.php';


class CheckoutService extends ClientService
{

    public function createCart($draft)
    {
        
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
        
    }

    public function createOrderFromCart($draft)
    {

        
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
        
    }
}
