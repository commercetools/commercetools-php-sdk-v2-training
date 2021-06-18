<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\Subscription\SubscriptionDraftBuilder;
use Commercetools\Api\Models\Subscription\MessageSubscriptionCollection;
use Commercetools\Api\Models\Subscription\MessageSubscriptionBuilder;
use Commercetools\Api\Models\Subscription\GoogleCloudPubSubDestinationBuilder;



include 'services/subscriptionService.php';


print_r(createNewSubscription());

function createNewSubscription()
{
    $SubscriptionService = new SubscriptionService();
    $draft;
    return $SubscriptionService->createSubscription($draft);
}

