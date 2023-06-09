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

    $draft = TypeDraftBuilder::of()
        ->withKey('nd-allowed-to-place-orders')
        ->withName(LocalizedStringBuilder::of()
            ->put('en-US','nd customer custom fields')
            ->build())
        ->withResourceTypeIds(['customer'])
        ->withFieldDefinitions(
            FieldDefinitionCollection::of()
                ->add(FieldDefinitionBuilder::of()
                    ->withType(CustomFieldBooleanTypeBuilder::of()
                        ->build())
                    ->withName('allowed-to-place-orders')
                    ->withLabel(LocalizedStringBuilder::of()
                        ->put('en-US','Allowed to order?')
                        ->build())
                    ->withRequired(true)
                    ->build())
                ->add(FieldDefinitionBuilder::of()
                    ->withType(CustomFieldStringTypeBuilder::of()
                        ->build())
                    ->withName('reason')
                    ->withLabel(LocalizedStringBuilder::of()
                        ->put('en-US','Reason')
                        ->build())
                    ->withRequired(true)
                    ->build())
            )
        ->build();

    return $CustomizationService->createType($draft);
}
