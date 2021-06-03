<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\Cart\CartUpdateBuilder;
use Commercetools\Api\Models\Order\OrderUpdateBuilder;

include 'clientService.php';


class CheckoutService extends ClientService
{

    public function createCart($draft)
    {
        $builder = $this->getApiBuilder();
        $request = $builder->with()->carts()->post($draft);
        $response = $request->execute();

        return $response;
    }

    public function getCartById($id)
    {
        $builder = $this->getApiBuilder();
        $request = $builder->with()->carts()->withId($id)->get();
        $response = $request->execute();

        return $response;
    }

    public function updateCart($actionCollection, $id)
    {
        $cart = $this->getCartById($id);

        $builder = $this->getApiBuilder();
        $updateBuilder = new CartUpdateBuilder();
        $updateBuilder = $updateBuilder->withVersion($cart->getVersion())->withActions($actionCollection)->build();

        $request = $builder->with()->carts()->withId($id)->post($updateBuilder);
        $response = $request->execute();

        return $response;
    }

    public function createOrderFromCart($draft)
    {

        $builder = $this->getApiBuilder();
        $request = $builder->with()->orders()->post($draft);
        $response = $request->execute();

        return $response;
    }

    public function getOrderById($id)
    {
        $builder = $this->getApiBuilder();
        $request = $builder->with()->orders()->withId($id)->get();
        $response = $request->execute();

        return $response;
    }

    public function updateOrder($actionCollection, $id)
    {
        $order = $this->getOrderById($id);

        $builder = $this->getApiBuilder();
        $updateBuilder = new OrderUpdateBuilder();
        $updateBuilder = $updateBuilder->withVersion($order->getVersion())->withActions($actionCollection)->build();

        $request = $builder->with()->orders()->withId($id)->post($updateBuilder);
        $response = $request->execute();

        return $response;
    }

    public function createPayment($draft)
    {

        $builder = $this->getApiBuilder();
        $request = $builder->with()->payments()->post($draft);
        $response = $request->execute();

        return $response;
    }

    public function customerSignIn($draft)
    {
        $builder = $this->getApiBuilder();
        $request = $builder->with()->login()->post($draft);
        $response = $request->execute();

        return $response;
    }
}
