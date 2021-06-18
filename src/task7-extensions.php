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

    $draft;

    return $ExtensionService->createType($draft);
}

function createNewExtension()
{
    $ExtensionService = new ExtensionService();
    $extensionURL = 'https://europe-west3-ct-support.cloudfunctions.net/training-extensions-sample';
    $draft;

    return $ExtensionService->createExtension($draft);
}

