<?php

namespace Commercetools\Training;
use Commercetools\Api\Models\Type\TypeDraftBuilder;
use Commercetools\Api\Models\Type\FieldDefinitionCollection;
use Commercetools\Api\Models\Type\FieldDefinitionBuilder;
use Commercetools\Api\Models\Type\CustomFieldBooleanTypeBuilder;

use Commercetools\Api\Models\Extension\ExtensionDraftBuilder;
use Commercetools\Api\Models\Extension\ExtensionHttpDestinationBuilder;
use Commercetools\Api\Models\Extension\ExtensionTriggerCollection;
use Commercetools\Api\Models\Extension\ExtensionTriggerBuilder;




use Commercetools\Api\Models\Common\LocalizedStringBuilder;

include 'services/extensionService.php';


print_r(createNewExtension());

function createNewType()
{
    $ExtensionService = new ExtensionService();

    $draft = TypeDraftBuilder::of()
    ->withKey('allowed-to-place-orders')
    ->withName(LocalizedStringBuilder::of()->put('de','allow-to-place-orders')->build())
    ->withResourceTypeIds(['customer'])
    ->withFieldDefinitions(
        FieldDefinitionCollection::of()
        ->add(
            FieldDefinitionBuilder::of()
            ->withType(
                CustomFieldBooleanTypeBuilder::of()->build()
            )
            ->withName('allowed-to-place-orders')
            ->withLabel(LocalizedStringBuilder::of()->put('de','allow-to-place-orders')->build())
            ->withRequired(false)
            ->build()
        )
    )
    ->build();

    return $ExtensionService->createType($draft);
}

function createNewExtension()
{
    $ExtensionService = new ExtensionService();
    $extensionURL = 'https://europe-west3-ct-support.cloudfunctions.net/training-extensions-sample';
    $draft = ExtensionDraftBuilder::of()
            ->withKey('orderChecker')
            ->withDestination(
                ExtensionHttpDestinationBuilder::of()->withUrl($extensionURL)->build()
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

    return $ExtensionService->createExtension($draft);
}

