<?php

namespace Commercetools\Training;

include 'clientService.php';


class CustomizationService extends ClientService
{

    public function createExtension($draft)
    {
        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->extensions()
            ->post($draft)
            ->execute();
    }

   

    public function createSubscription($draft)
    {
        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->subscriptions()
            ->post($draft)
            ->execute();
    }

    public function createType($draft)
    {
        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->types()
            ->post($draft)
            ->execute();
    }

    public function createCustomObject($draft)
    {
        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->customObjects()
            ->post($draft)
            ->execute();
    }

}
