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
    
    $draft;

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
   
    $actionCollection ;
    
    return $StateService->updateState($actionCollection,$id);
}
