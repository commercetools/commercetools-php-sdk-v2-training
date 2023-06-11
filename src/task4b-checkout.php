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
use Commercetools\Api\Models\Payment\PaymentMethodInfoBuilder;
use Commercetools\Api\Models\Payment\PaymentResourceIdentifierBuilder;
use Commercetools\Api\Models\Payment\PaymentDraftBuilder;
use Commercetools\Api\Models\Customer\CustomerResourceIdentifierBuilder;
use Commercetools\Api\Models\Common\MoneyBuilder;
use Commercetools\Api\Models\Customer\CustomerSigninBuilder;
use Commercetools\Api\Models\Common\LocalizedStringBuilder;


include 'services/checkoutService.php';
include 'services/customerService.php';

$customerKey = '';
$cartId = '';
$orderId = '';

print_r(createCart($customerKey, 'EUR'));

function createCart($customerKey, $currencyCode)
{
    $checkoutService = new CheckoutService();
    $customerService = new CustomerService();

    $customer = $customerService->getCustomerWithKey($customerKey);
    $countryCode='DE';
    
    $cartDraft = CartDraftBuilder::of();

    // TODO create cart

    return $checkoutService->createCart($cartDraft);
}

function addLineItemsToCart($cartId, $arrayOfSkus)
{
    $checkoutService = new CheckoutService();

    $actionCollection = CartUpdateActionCollection::of();
   
    // TODO create add line items to the cart action collection

    return $checkoutService->updateCart($cartId, $actionCollection);
    
}

function addDiscountCodeToCart($cartId, $code)
{
    $checkoutService = new CheckoutService();
    $actionCollection = CartUpdateActionCollection::of();
   
    // TODO create add discount to the cart action collection

    return $checkoutService->updateCart($cartId, $actionCollection);
}

function createOrderFromCart($cartId)
{
    $checkoutService = new CheckoutService();
    $cart = $checkoutService->getCartById($cartId);
    
    $draft = OrderFromCartDraftBuilder::of();

    // TODO create order from cart draft

    return $checkoutService->createOrderFromCart($draft);
}

function updateOrderStatus($orderId, $state)
{
    $checkoutService = new CheckoutService();
    $actionCollection = OrderUpdateActionCollection::of();

    // TODO create order state update action collection

    return $checkoutService->updateOrder($orderId, $actionCollection);
}

function createPayment($customerKey, $orderId)
{
    $checkoutService = new CheckoutService();
    $order = $checkoutService->getOrderById($orderId);
    
    $builder = PaymentDraftBuilder::of();
    $draft = $builder
        ->withKey('nd-order-payment')
        ->withCustomer(
            CustomerResourceIdentifierBuilder::of()
                ->withKey($customerKey)
                ->build())
        ->withAmountPlanned(
            MoneyBuilder::of()
                ->withCentAmount($order->getTotalPrice()->getCentAmount())
                ->withCurrencyCode($order->getTotalPrice()->getCurrencyCode())
                ->build())
        ->withPaymentMethodInfo(
            PaymentMethodInfoBuilder::of()
                ->withPaymentInterface('PSP')
                ->withMethod('Credit')
                ->withName(LocalizedStringBuilder::of()
                    ->put('en', 'nd payment')->build())
                ->build()
        )
        ->build();
        
    return $checkoutService->createPayment($draft);
}
function addPaymentToOrder($orderId, $paymentId)
{
    $checkoutService = new CheckoutService();
    $actionCollection = OrderUpdateActionCollection::of();
    
        $action = OrderAddPaymentActionBuilder::of()
            ->withPayment(
                PaymentResourceIdentifierBuilder::of()
                ->withId($paymentId)->build())
            ->build();
        $actionCollection = $actionCollection->add($action);
    
    return $checkoutService->updateOrder($orderId, $actionCollection);
}

function fullCheckoutSimulation($customerKey, $currencyCode)
{
    $emptyCart = createCart($customerKey, $currencyCode);

    $filledCart = addLineItemsToCart($emptyCart->getId(), ['tulip-seed-box','tulip-seed-package']);
    
    $filledCart = addDiscountCodeToCart($filledCart->getId(), 'TULIPS_BOGO');

    $order = createOrderFromCart($filledCart->getId());

    // $payment = createPayment($customerKey, $order->getId());
    // $order = addPaymentToOrder($order->getId(), $payment->getId());

    $order = updateOrderStatus($order->getId(), 'Confirmed');
    
    return $order;
    
}

function createAnonymousCart($currencyCode)
{
    $checkoutService = new CheckoutService();
    $countryCode='DE';

    $builder = CartDraftBuilder::of();
    $draft = $builder
        ->withCurrency($currencyCode)
        ->withCountry($countryCode)
        ->withShippingAddress(
            BaseAddressBuilder::of()
                ->withCountry($countryCode)
                ->build())
        ->build();

    return $checkoutService->createCart($draft);
}

function cartMergingSimulation($customerKey, $currencyCode)
{
    $emptyCustomerCart = createCart($customerKey, $currencyCode);
    $filledCustomerCart = addLineItemsToCart($emptyCustomerCart->getId(), ['tulip-seed-box','tulip-seed-box']);

    $emptyAnonymousCart = createAnonymousCart($currencyCode);
    $filledAnonymousCart = addLineItemsToCart($emptyAnonymousCart->getId(), ['tulip-seed-box','tulip-seed-package']);
    

    print_r($filledAnonymousCart->getId()); // look it up in impex you will see it's merged
    echo "\n";
    print_r($filledCustomerCart->getId());
    echo "\n";
    $checkoutService = new CheckoutService();
    $builder = CustomerSigninBuilder::of();
    $draft = $builder->withEmail('test.user@test.com')
        ->withPassword('password')
        ->withAnonymousCartId($filledAnonymousCart->getId())
        ->withAnonymousCartSignInMode('UseAsNewActiveCustomerCart') //default is MergeWithExistingCustomerCart
        ->build();
    return $checkoutService->customerSignIn($draft);
}