<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\Extension\ExtensionDraftBuilder;
use Commercetools\Api\Models\Extension\GoogleCloudFunctionDestinationBuilder;
use Commercetools\Api\Models\Extension\ExtensionTriggerCollection;
use Commercetools\Api\Models\Extension\ExtensionTriggerBuilder;

include 'services/customizationService.php';


print_r(createNewExtension());

function createNewExtension()
{
    $CustomizationService = new CustomizationService();
    $extensionURL = 'https://europe-west3-ct-support.cloudfunctions.net/training-extensions-sample';
    $draft = ExtensionDraftBuilder::of();

    // TODO create an extension draft with order create as the trigger

    return $CustomizationService->createExtension($draft);
}

