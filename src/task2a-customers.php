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


print_r(createCustomer());

function createCustomer()
{
    $customerService = new customerService();
    
    $email='test-user@example.com';
    $password='password';
    $customerKey='nd-customer';
    
    // TODO
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
    
    // TODO
}

function setCustomerGroup($customerKey, $customerGroupKey)
{
    $customerService = new customerService();
    
    // TODO
}
