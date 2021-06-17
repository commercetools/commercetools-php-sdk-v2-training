<?php

namespace Commercetools\Training;

include 'clientService.php';


class ExtensionService extends ClientService
{

    public function createExtension($draft)
    {
        $builder = $this->getApiBuilder();
        $request = $builder->with()->extensions()->post($draft);
        $response = $request->execute();

        return $response;
    }

    public function createType($draft)
    {
        $builder = $this->getApiBuilder();
        $request = $builder->with()->types()->post($draft);
        $response = $request->execute();

        return $response;
    }
}
