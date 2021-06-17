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
    $draft = SubscriptionDraftBuilder::of()
             ->withKey('subscriptionSample')
             ->withDestination(
                GoogleCloudPubSubDestinationBuilder::of()
                ->withProjectId('ct-support')
                ->withTopic('training-subscription-sample')
                ->build()
             )
             ->withMessages(
                MessageSubscriptionCollection::of()->add(
                    MessageSubscriptionBuilder::of()
                    ->withResourceTypeId('order')
                    ->withTypes(['OrderCreated'])
                    ->build()
                )
             )
             ->build();
    return $SubscriptionService->createSubscription($draft);
}

