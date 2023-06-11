<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\Customer\CustomerBuilder;
use Commercetools\Api\Models\Customer\CustomerUpdateBuilder;

include_once 'clientService.php';


class CustomerService extends ClientService
{

    public function createCustomer($draft)
    {
        return CustomerBuilder::of();
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
        return CustomerBuilder::of();
    }

    public function updateCustomer($customerKey, $actionCollection)
    {
        return CustomerBuilder::of();
    }
}
