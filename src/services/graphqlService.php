<?php

namespace Commercetools\Training;

use Commercetools\Api\Models\GraphQl\GraphQLRequestBuilder;

include 'clientService.php';


class GraphqlService extends ClientService
{

    public function postGraphQlQuery($query)
    {
        $apiRoot = $this->getApiClient();
        $gqlRequest = GraphQLRequestBuilder::of()
          ->withQuery($query)
          ->build();

        return $apiRoot->with()
          ->graphql()
          ->post($gqlRequest)
          ->execute();
    }
}
