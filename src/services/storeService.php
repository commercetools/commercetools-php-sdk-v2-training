<?php

namespace Commercetools\Training;

include 'clientService.php';


class StoreService extends ClientService
{

    public function getCustomersInAStore($storeKey)
    {
        $builder = $this->getStoreBuilder();
        $request = $builder->with()->inStoreKeyWithStoreKeyValue($storeKey)->customers()->get();
        $response = $request->execute();

        return $response;
    }
}