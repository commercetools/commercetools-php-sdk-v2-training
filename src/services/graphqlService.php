<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\GraphQl\GraphQLRequestBuilder;
use Commercetools\Api\Models\GraphQl\GraphQLResponseBuilder;

include 'clientService.php';


class GraphqlService extends ClientService
{

    public function postGraphQlQuery($query)
    {
        return GraphQLResponseBuilder::of();
    }
}
