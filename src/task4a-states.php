<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\State\StateDraftBuilder;
use Commercetools\Api\Models\State\StateUpdateActionCollection;
use Commercetools\Api\Models\State\StateSetTransitionsActionBuilder;
use Commercetools\Api\Models\State\StateResourceIdentifierBuilder;
use Commercetools\Api\Models\State\StateResourceIdentifierCollection;
use Commercetools\Api\Models\Common\LocalizedStringBuilder;

include 'services/stateService.php';


print_r(createOrderWorkflow());

function createOrderWorkflow()
{
    $StateService = new StateService();
    
    $builder = StateDraftBuilder::of();

    $orderPackedStateDraft = $builder
        ->withKey('nd-order-packed')
        ->withInitial(false)
        ->withType('OrderState')
        ->withName(LocalizedStringBuilder::of()
            ->put('en', 'nd order packed')->build())
        ->build();
    
    $orderPackedState = $StateService->createState($orderPackedStateDraft);

    $orderShippedStateDraft = $builder
        ->withKey('nd-order-shipped')
        ->withInitial(false)
        ->withType('OrderState')
        ->withName(LocalizedStringBuilder::of()
            ->put('en', 'nd order shipped')->build())
        ->build();

    $orderShippedState = $StateService->createState($orderShippedStateDraft);

    // TODO update orderPacked state and set transition to orderShipped state
}

