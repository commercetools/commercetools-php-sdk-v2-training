<?php

namespace Commercetools\Training;

include 'services/graphqlService.php';


print_r(getCustomersWithOrders());

function getCustomersWithOrders()
{
    $GraphqlService = new GraphqlService();

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
    return $GraphqlService->postGraphQlQuery($query);
}

