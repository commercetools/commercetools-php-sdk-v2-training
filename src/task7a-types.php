<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\Type\TypeDraftBuilder;
use Commercetools\Api\Models\Type\FieldDefinitionCollection;
use Commercetools\Api\Models\Type\FieldDefinitionBuilder;
use Commercetools\Api\Models\Type\CustomFieldBooleanTypeBuilder;
use Commercetools\Api\Models\Type\CustomFieldStringTypeBuilder;

use Commercetools\Api\Models\Common\LocalizedStringBuilder;


include 'services/customizationService.php';


print_r(createNewType());

function createNewType()
{
    $CustomizationService = new CustomizationService();

    $draft = TypeDraftBuilder::of();

    // TODO create a type draft with custom fields

    return $CustomizationService->createType($draft);
}
