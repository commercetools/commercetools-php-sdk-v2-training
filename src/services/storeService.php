<?php

namespace Commercetools\Training;
use Commercetools\Api\Models\Cart\CartBuilder;
use Commercetools\Api\Models\Customer\CustomerBuilder;

include 'clientService.php';


class StoreService extends ClientService
{

    public function getCustomersInAStore($storeKey)
    {
        return CustomerBuilder::of();
    }

    public function createInstoreCart($draft, $storeKey)
    {
        return CartBuilder::of();
    }
}