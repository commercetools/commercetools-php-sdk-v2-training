<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\Common\BaseAddressBuilder;
use Commercetools\Api\Models\Common\BaseAddressCollection;
use Commercetools\Api\Models\Customer\CustomerDraftBuilder;
use Commercetools\Api\Models\Customer\CustomerUpdateActionCollection;
use Commercetools\Api\Models\Customer\CustomerSetFirstNameActionBuilder;
use Commercetools\Api\Models\Customer\CustomerSetCustomerGroupActionBuilder;
use Commercetools\Api\Models\CustomerGroup\CustomerGroupResourceIdentifierBuilder;

include 'services/customerService.php';


print_r(setCustomerGroup('nd-customer', 'vip-customers'));

function createCustomer()
{
    $customerService = new customerService();
    
    $email='test-user@example.com';
    $password='password';
    $customerKey='nd-customer';
    
    $draft = CustomerDraftBuilder::of()
        ->withKey($customerKey)
        ->withEmail($email)
        ->withPassword($password)
        ->withFirstName('Test')
        ->withLastName('User')
        ->withAddresses(BaseAddressCollection::of()
            ->add(BaseAddressBuilder::of()
            ->withCountry('DE')
            ->withFirstName('Test')
            ->withLastName('User')
            ->withKey('nd-customer-home')
            ->build()))
        ->withDefaultBillingAddress(0)
        ->withDefaultShippingAddress(0)
        ->build();

    return $customerService->createCustomer($draft);
}

function getAllCustomers()
{
    $customerService = new customerService();

    return $customerService->getAllCustomers();
}

function getCustomerWithId($id)
{
    $customerService = new customerService();
    return $customerService->getCustomerWithId($id);
}

function setCustomerFirstName($customerKey, $firstName)
{
    $customerService = new customerService();
    
    $action = CustomerSetFirstNameActionBuilder::of()
        ->withFirstName($firstName)
        ->build();
    $actionCollection = CustomerUpdateActionCollection::of()->add($action);

    return $customerService->updateCustomer($customerKey, $actionCollection);
}

function setCustomerGroup($customerKey, $customerGroupKey)
{
    $customerService = new customerService();
    
    $action = CustomerSetCustomerGroupActionBuilder::of()
        ->withCustomerGroup(
            CustomerGroupResourceIdentifierBuilder::of()
                ->withKey($customerGroupKey)
                ->build())
            ->build();
    $actionCollection = CustomerUpdateActionCollection::of()->add($action);

    return $customerService->updateCustomer($customerKey, $actionCollection);
}
