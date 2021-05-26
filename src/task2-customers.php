<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\Customer\CustomerDraftBuilder;
use Commercetools\Api\Models\Customer\CustomerUpdateActionBuilder;
use Commercetools\Api\Models\Customer\CustomerUpdateActionCollection;
use Commercetools\Api\Models\Customer\CustomerUpdateBuilder;
use Commercetools\Api\Models\Customer\CustomerSetFirstNameActionBuilder;
use Commercetools\Api\Models\Customer\CustomerSetCustomerGroupActionBuilder;
use Commercetools\Api\Models\CustomerGroup\CustomerGroupResourceIdentifierBuilder;

use Commercetools\Api\Client\ApiRequestBuilder;

include 'services/customerService.php';


print_r(addCustomerToCustomerGroup());

function createCustomer(){
    $customerService = new customerService();
    $email='ff-test1@test.com';
   
    $password='123';
    $builder = CustomerDraftBuilder::of();
    $draft = $builder->withEmail($email)->withPassword($password)->build();
    return $customerService->createCustomer($draft);
}
function getAllCustomers(){
    $customerService = new customerService();
    return $customerService->getAllCustomers();
}
function getCustomerWithId(){
    $customerService = new customerService();
    $id = 'a0db8293-38ee-42a8-a7c9-ab8c6b627baa';

    return $customerService->getCustomerWithId($id);
}
function updateCustomerFirstName(){
    $customerService = new customerService();
    $id = 'a0db8293-38ee-42a8-a7c9-ab8c6b627baa';
    $name = 'fady';
    $action = CustomerSetFirstNameActionBuilder::of()->withFirstName($name)->build();
    $actionCollection = CustomerUpdateActionCollection::of()->add($action);

    return $customerService->updateCustomer($actionCollection, $id);
}
function addCustomerToCustomerGroup(){
    $customerService = new customerService();
    $id = 'a0db8293-38ee-42a8-a7c9-ab8c6b627baa';
    $customerGroupKey = 'testCustomerGroup123';
    
    $action = CustomerSetCustomerGroupActionBuilder::of()
    ->withCustomerGroup(CustomerGroupResourceIdentifierBuilder::of()->withKey($customerGroupKey)->build())->build();
    $actionCollection = CustomerUpdateActionCollection::of()->add($action);

    return $customerService->updateCustomer($actionCollection, $id);
}
