<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\State\StateDraftBuilder;
use Commercetools\Api\Models\State\StateUpdateActionCollection;
use Commercetools\Api\Models\State\StateSetTransitionsActionBuilder;
use Commercetools\Api\Models\State\StateResourceIdentifierBuilder;
use Commercetools\Api\Models\State\StateResourceIdentifierCollection;
use Commercetools\Api\Models\Common\LocalizedStringBuilder;

include 'services/storeService.php';


print_r(getCustomerInstore());

function getCustomerInstore()
{
    $StoreService = new StoreService();

    return $StoreService->getCustomersInAStore('eg-store');
}


