<?php

namespace Commercetools\Training;
use Commercetools\Api\Models\State\StateUpdateBuilder;
include 'clientService.php';


class StateService extends ClientService
{

    public function createState($draft)
    {

        $builder = $this->getApiBuilder();
        $request = $builder->with()->states()->post($draft);
        $response = $request->execute();
        return $response;
    }

    public function getAllStates()
    {

        $builder = $this->getApiBuilder();
        $request = $builder->with()->states()->get();
        $response = $request->execute();
        return $response;
    }
    public function getStateWithId($id)
    {

        $builder = $this->getApiBuilder();
        $request = $builder->with()->states()->withId($id)->get();
        $response = $request->execute();
        return $response;
    }
    public function updateState($actionCollection, $id)
    {   $state = $this->getStateWithId($id);

        $builder = $this->getApiBuilder();
        $updateBuilder = new StateUpdateBuilder();
        $updateBuilder = $updateBuilder->withVersion($state->getVersion())->withActions($actionCollection)->build();

        $request = $builder->with()->states()->withId($id)->post($updateBuilder);
        $response = $request->execute();
        return $response;
    }
}
