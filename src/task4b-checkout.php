<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\Cart\CartDraftBuilder;
use Commercetools\Api\Models\Cart\CartUpdateActionCollection;
use Commercetools\Api\Models\Cart\CartAddLineItemActionBuilder;
use Commercetools\Api\Models\Cart\CartAddDiscountCodeActionBuilder;
use Commercetools\Api\Models\Order\OrderFromCartDraftBuilder;
use Commercetools\Api\Models\Cart\CartResourceIdentifierBuilder;
use Commercetools\Api\Models\Common\BaseAddressBuilder;
use Commercetools\Api\Models\Order\OrderUpdateActionCollection;
use Commercetools\Api\Models\Order\OrderChangeOrderStateActionBuilder;
use Commercetools\Api\Models\Order\OrderAddPaymentActionBuilder;
use Commercetools\Api\Models\Payment\PaymentResourceIdentifierBuilder;
use Commercetools\Api\Models\Payment\PaymentDraftBuilder;
use Commercetools\Api\Models\Customer\CustomerResourceIdentifierBuilder;
use Commercetools\Api\Models\Common\MoneyBuilder;
use Commercetools\Api\Models\Customer\CustomerSigninBuilder;


include 'services/checkoutService.php';


print_r(cartMergingSimulation());

function createCart()
{
    $checkoutService = new CheckoutService();
    $currency='EUR';
    $countryCode='DE';
    $customerId='10cb16bf-a5d8-4f47-b664-fe5cae2f75d0';

    $builder = CartDraftBuilder::of();
    $draft = $builder->withCurrency($currency)
    ->withCustomerId($customerId)
    ->withShippingAddress(BaseAddressBuilder::of()->withCountry($countryCode)->build())
    ->build();

    return $checkoutService->createCart($draft);
}

function getCartById()
{
    $checkoutService = new CheckoutService();
    $cartId = '2635a694-3286-4d6a-861a-77f2e51c6262';
    return $checkoutService->getCartById($cartId);
}

function addLineItemsToCart($arrayOfSkus,$cartId)
{
    $checkoutService = new CheckoutService();
    $actionCollection = CartUpdateActionCollection::of();
    foreach ($arrayOfSkus as $sku) {
        $action = CartAddLineItemActionBuilder::of()->withSku($sku)->build();
        $actionCollection = $actionCollection->add($action);
    }

    return $checkoutService->updateCart($actionCollection,$cartId);
}

function addDiscountCodeToCart($code,$cartId)
{
    $checkoutService = new CheckoutService();
    $actionCollection = CartUpdateActionCollection::of();
   
        $action = CartAddDiscountCodeActionBuilder::of()->withCode($code)->build();
        $actionCollection = $actionCollection->add($action);
    

    return $checkoutService->updateCart($actionCollection,$cartId);
}

function createOrderFromCart($cartId)
{
    $checkoutService = new CheckoutService();
    $cart = $checkoutService->getCartById($cartId);
    
    $builder = OrderFromCartDraftBuilder::of();
    $draft = $builder->withCart(CartResourceIdentifierBuilder::of()->withId($cartId)->build())
    ->withVersion($cart->getVersion())
    ->build();

    return $checkoutService->createOrderFromCart($draft);
}

function getOrderById()
{
    $checkoutService = new CheckoutService();
    $orderId = '53d72533-863b-4e54-830a-b4cf62d75ed8';
    return $checkoutService->getOrderById($orderId);
}

function updateOrderStatus($state,$orderId)
{
    $checkoutService = new CheckoutService();
    $actionCollection = OrderUpdateActionCollection::of();

        $action = OrderChangeOrderStateActionBuilder::of()->withOrderState($state)->build();
        $actionCollection = $actionCollection->add($action);
    

    return $checkoutService->updateOrder($actionCollection,$orderId);
}

function createPayment()
{
    $checkoutService = new CheckoutService();
    $currency='EUR';
    $amount='4200';
    $customerId='10cb16bf-a5d8-4f47-b664-fe5cae2f75d0';

    $builder = PaymentDraftBuilder::of();
    $draft = $builder
    ->withCustomer(
        CustomerResourceIdentifierBuilder::of()->withId($customerId)->build()
    )
    ->withAmountPlanned(
        MoneyBuilder::of()->withCentAmount($amount)
        ->withCurrencyCode($currency)->build()
    )
    ->build();

    return $checkoutService->createPayment($draft);
}
function addPaymentToOrder($paymentId,$orderId)
{
    $checkoutService = new CheckoutService();
    $actionCollection = OrderUpdateActionCollection::of();
    
        $action = OrderAddPaymentActionBuilder::of()
        ->withPayment(
            PaymentResourceIdentifierBuilder::of()
            ->withId($paymentId)->build()
        )
        ->build();
        $actionCollection = $actionCollection->add($action);
    

    return $checkoutService->updateOrder($actionCollection,$orderId);
}

function fullCheckoutSimulation()
{
    $emptyCart = createCart();

    $filledCart = addLineItemsToCart(['123','123'],$emptyCart->getId());
    $filledCart = addDiscountCodeToCart('SUMMER',$filledCart->getId());

    $payment = createPayment();
    $order = createOrderFromCart($filledCart->getId());
    $order = addPaymentToOrder($payment->getId(),$order->getId());
    $order = updateOrderStatus('Confirmed',$order->getId());
    return $order;
    
}

function createAnonymousCart()
{
    $checkoutService = new CheckoutService();
    $currency='EUR';
    $countryCode='DE';

    $builder = CartDraftBuilder::of();
    $draft = $builder->withCurrency($currency)
    ->withShippingAddress(BaseAddressBuilder::of()->withCountry($countryCode)->build())
    ->build();

    return $checkoutService->createCart($draft);
}

function cartMergingSimulation()
{
    $emptyCustomerCart = createCart();
    $emptyAnonymousCart = createAnonymousCart();

    $filledAnonymousCart = addLineItemsToCart(['123','123'],$emptyAnonymousCart->getId());
    $filledCustomerCart = addLineItemsToCart(['123'],$emptyCustomerCart->getId());

    print_r($filledAnonymousCart->getId()); // look it up in impex you will see it's merged
    echo "\n";
    print_r($filledCustomerCart->getId());
    echo "\n";
    $checkoutService = new CheckoutService();
    $builder = CustomerSigninBuilder::of();
    $draft = $builder->withEmail('persona1@example.com')
    ->withPassword('123')
    ->withAnonymousCartId($filledAnonymousCart->getId())
    ->build();
    return $checkoutService->customerSignIn($draft);
    
}