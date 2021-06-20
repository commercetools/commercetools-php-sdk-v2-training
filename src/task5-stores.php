<?php

namespace Commercetools\Training;



include 'services/storeService.php';


print_r(getCustomerInstore());

function getCustomerInstore()
{
    $StoreService = new StoreService();

    return $StoreService->getCustomersInAStore('eg-store');
}