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
    $draft = ExtensionDraftBuilder::of()
            ->withKey('nd-orderChecker')
            ->withDestination(
                GoogleCloudFunctionDestinationBuilder::of()
                    ->withUrl($extensionURL)
                    ->build()
            )
            ->withTriggers(
                ExtensionTriggerCollection::of()
                ->add(
                    ExtensionTriggerBuilder::of()
                    ->withResourceTypeId('order')
                    ->withActions(['Create'])
                    ->build()
                )
            )->build();

    return $CustomizationService->createExtension($draft);
}

