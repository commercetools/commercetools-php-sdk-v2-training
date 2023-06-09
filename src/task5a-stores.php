<?php

namespace Commercetools\Training;
use Commercetools\Api\Models\Cart\CartDraftBuilder;
use Commercetools\Api\Models\Common\BaseAddressBuilder;
use Commercetools\Api\Models\Store\StoreResourceIdentifierBuilder;



include 'services/storeService.php';
include 'services/customerService.php';

$customerKey = '';
$storeKey = '';

print_r(createInstoreCart($customerKey, 'EUR', $storeKey));

function getCustomerInstore($storeKey)
{
    $StoreService = new StoreService();

    return $StoreService->getCustomersInAStore($storeKey);
}

function createInstoreCart($customerKey, $currencyCode, $storeKey)
{
    $StoreService = new StoreService();
    $customerService = new CustomerService();
    
    $countryCode='DE';

    $customer = $customerService->getCustomerWithKey($customerKey);

    $cartDraft = (CartDraftBuilder::of())
        ->withCurrency($currencyCode)
        ->withCountry($countryCode)
        ->withCustomerId($customer->getId())
        ->withCustomerEmail($customer->getEmail())
        ->withDeleteDaysAfterLastModification(10)
        ->withShippingAddress(
            BaseAddressBuilder::of()
                ->withCountry($countryCode)
                ->build())
        ->withStore(StoreResourceIdentifierBuilder::of()
            ->withKey($storeKey)
            ->build())
        ->build();
    return $StoreService->createInstoreCart($cartDraft, $storeKey);
}