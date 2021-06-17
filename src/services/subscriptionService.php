<?php

namespace Commercetools\Training;

include 'clientService.php';


class SubscriptionService extends ClientService
{

    public function createSubscription($draft)
    {
        $builder = $this->getApiBuilder();
        $request = $builder->with()->subscriptions()->post($draft);
        $response = $request->execute();

        return $response;
    }

   
}
