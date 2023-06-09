<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\Customer\CustomerUpdateBuilder;

include_once 'clientService.php';


class CustomerService extends ClientService
{

    public function createCustomer($draft)
    {
        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->customers()
            ->post($draft)
            ->execute();
    }

    public function getAllCustomers()
    {
        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->customers()
            ->get()
            ->execute();
    }

    public function getCustomerWithId($id)
    {
        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->customers()
            ->withId($id)
            ->get()
            ->execute();
    }

    public function getCustomerWithKey($customerKey)
    {
        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->customers()
            ->withKey($customerKey)
            ->get()
            ->execute();
    }

    public function updateCustomer($customerKey, $actionCollection)
    {
        $customer = $this->getCustomerWithKey($customerKey);

        $apiRoot = $this->getApiClient();
        
        $updateBuilder = new CustomerUpdateBuilder();
        $customerUpdate = $updateBuilder
            ->withVersion($customer->getVersion())
            ->withActions($actionCollection)
            ->build();

        return $apiRoot->with()
            ->customers()
            ->withId($customer->getId())
            ->post($customerUpdate)
            ->execute();
    }
}
