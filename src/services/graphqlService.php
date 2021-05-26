<?php

namespace Commercetools\Training;
use Commercetools\Api\Models\GraphQl\GraphQLRequestBuilder;

include 'clientService.php';


class GraphqlService extends ClientService
{

    public function getCustomersWithOrders()
    {
        $query = 'query {
            orders {
              results {
                customer {
                  email
                }
                lineItems {
                  nameAllLocales {
                    value
                  }
                }
                totalPrice {
                  centAmount
                }
              }
            }
          }';
        $builder = $this->getApiBuilder();
        $gqlRequest = GraphQLRequestBuilder::of()->withQuery($query)->build();
        $request = $builder->with()->graphql()->post($gqlRequest);
        $response = $request->execute();
        return $response;
    }

  
    
}
