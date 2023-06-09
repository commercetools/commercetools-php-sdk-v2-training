<?php

namespace Commercetools\Training;

include 'clientService.php';


class StoreService extends ClientService
{

    public function getCustomersInAStore($storeKey)
    {
        $apiRoot = $this->getStoreClient();
        return $apiRoot->with()
            ->inStoreKeyWithStoreKeyValue($storeKey)
            ->customers()
            ->get()
            ->execute();
    }

    public function createInstoreCart($draft, $storeKey)
    {
        $apiRoot = $this->getStoreClient();
        return $apiRoot->with()
            ->inStoreKeyWithStoreKeyValue($storeKey)
            ->carts()
            ->post($draft)
            ->execute();
    }
}