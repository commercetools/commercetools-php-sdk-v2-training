<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\Cart\CartBuilder;
use Commercetools\Api\Models\Cart\CartUpdateBuilder;
use Commercetools\Api\Models\Customer\CustomerSignInResult;
use Commercetools\Api\Models\Order\OrderBuilder;
use Commercetools\Api\Models\Order\OrderUpdateBuilder;

include 'clientService.php';


class CheckoutService extends ClientService
{

    public function createCart($draft)
    {
        return CartBuilder::of();
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
        return CartBuilder::of();
    }

    public function createOrderFromCart($draft)
    {
        return CartBuilder::of();
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
        return OrderBuilder::of();
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
        return CustomerSignInResult::of();
    }
}
