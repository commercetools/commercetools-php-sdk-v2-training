<?php

namespace Commercetools\Training;

include 'services/graphqlService.php';


print_r(getCustomersWithOrders());

function getCustomersWithOrders()
{
    $GraphqlService = new GraphqlService();

    return $GraphqlService->getCustomersWithOrders();
}

