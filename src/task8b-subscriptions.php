<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\Subscription\SubscriptionDraftBuilder;
use Commercetools\Api\Models\Subscription\MessageSubscriptionCollection;
use Commercetools\Api\Models\Subscription\MessageSubscriptionBuilder;
use Commercetools\Api\Models\Subscription\GoogleCloudPubSubDestinationBuilder;


include 'services/customizationService.php';


print_r(createNewSubscription());

function createNewSubscription()
{
    $CustomizationService = new CustomizationService();
    $draft = SubscriptionDraftBuilder::of()
             ->withKey('nd-subscriptionSample')
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
    return $CustomizationService->createSubscription($draft);
}

