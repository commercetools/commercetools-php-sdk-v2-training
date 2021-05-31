<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\Customer\CustomerUpdateBuilder;

include 'clientService.php';


class CustomerService extends ClientService
{

    public function createCustomer($draft)
    {
        $builder = $this->getApiBuilder();
        $request = $builder->with()->customers()->post($draft);
        $response = $request->execute();

        return $response;
    }

    public function getAllCustomers()
    {
        $builder = $this->getApiBuilder();
        $request = $builder->with()->customers()->get();
        $response = $request->execute();

        return $response;
    }

    public function getCustomerWithId($id)
    {
        $builder = $this->getApiBuilder();
        $request = $builder->with()->customers()->withId($id)->get();
        $response = $request->execute();

        return $response;
    }

    public function updateCustomer($actionCollection, $id)
    {
        $customer = $this->getCustomerWithId($id);

        $builder = $this->getApiBuilder();
        $updateBuilder = new CustomerUpdateBuilder();
        $updateBuilder = $updateBuilder->withVersion($customer->getVersion())->withActions($actionCollection)->build();

        $request = $builder->with()->customers()->withId($id)->post($updateBuilder);
        $response = $request->execute();

        return $response;
    }
}
