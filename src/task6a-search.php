<?php

namespace Commercetools\Training;


include 'services/searchService.php';


print_r(simulateSearch());

function getAllProducts(){
    $SearchService = new SearchService();

    return $SearchService->getAllProducts();
}
function simulateSearch(){
    $SearchService = new SearchService();

    return $SearchService->simulateSearch();
}

