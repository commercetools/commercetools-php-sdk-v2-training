<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\CustomObject\CustomObjectDraftBuilder;

include 'services/customizationService.php';


print_r(createNewCustomObject());


function createNewCustomObject()
{
    $CustomizationService = new CustomizationService();

    $info = json_decode('{
        "incompatibleProducts": ["celery-seed-product"],
        "leafletID": "leaflet_1234",
        "instructions": {
            "title": "Flower Handling",
            "distance": "2 meter",
            "watering": "heavy"
        }
    }');
    $draft = CustomObjectDraftBuilder::of();

    // TODO create a custom object draft with the compatibility info above

    return $CustomizationService->createCustomObject($draft);
}


