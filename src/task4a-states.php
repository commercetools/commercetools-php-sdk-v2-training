<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\State\StateDraftBuilder;
use Commercetools\Api\Models\State\StateUpdateActionCollection;
use Commercetools\Api\Models\State\StateSetTransitionsActionBuilder;
use Commercetools\Api\Models\State\StateResourceIdentifierBuilder;
use Commercetools\Api\Models\State\StateResourceIdentifierCollection;
use Commercetools\Api\Models\Common\LocalizedStringBuilder;

include 'services/stateService.php';


print_r(addTransition());

function createState()
{
    $StateService = new StateService();
    $stateName = LocalizedStringBuilder::of()->put('en', 'testStat2')->build();
    $builder = StateDraftBuilder::of();
    $draft = $builder->withKey('testState-php-2')->withInitial(false)->withType('OrderState')->withName($stateName)->build();

    return $StateService->createState($draft);
}

function getAllStates()
{
    $StateService = new StateService();

    return $StateService->getAllStates();
}

function getStateWithId()
{
    $StateService = new StateService();
    $id = '94e418f2-efe5-4c50-a629-a72e43c0f5c5';

    return $StateService->getStateWithId($id);
}

function addTransition()
{
    $StateService = new StateService();
    $id='94e418f2-efe5-4c50-a629-a72e43c0f5c5';
    $destinationId = 'ddcfbb11-50f3-4520-8a1a-27cd191be097';
    $destinationState = StateResourceIdentifierBuilder::of()->withId($destinationId)->build();
    $resourceIdentifierCollection = StateResourceIdentifierCollection::of()->add($destinationState);
    $action = StateSetTransitionsActionBuilder::of()->withTransitions($resourceIdentifierCollection)->build();
    $actionCollection = StateUpdateActionCollection::of()->add($action);
    
    return $StateService->updateState($actionCollection,$id);
}
