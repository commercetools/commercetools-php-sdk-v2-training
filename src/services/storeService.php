<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\State\StateUpdateBuilder;
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
