<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\State\StateUpdateBuilder;
include 'clientService.php';


class StateService extends ClientService
{

    public function createState($draft)
    {
        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->states()
            ->post($draft)
            ->execute();
    }

    public function getAllStates()
    {
        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->states()
            ->get()
            ->execute();
    }

    public function getStateWithId($id)
    {
        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->states()
            ->withId($id)
            ->get()
            ->execute();
    }

    public function updateState($id, $actionCollection)
    {
        $state = $this->getStateWithId($id);

        $apiRoot = $this->getApiClient();

        $stateUpdate = (new StateUpdateBuilder())
            ->withVersion($state->getVersion())
            ->withActions($actionCollection)
            ->build();

        return $apiRoot->with()
            ->states()
            ->withId($id)
            ->post($stateUpdate)
            ->execute();
    }
}
