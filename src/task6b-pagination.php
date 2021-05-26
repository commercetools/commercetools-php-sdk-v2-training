<?php

namespace Commercetools\Training;


include 'services/searchService.php';


print_r(pagination());


function pagination(){
    $SearchService = new SearchService();
    $perPage = 1;
    $page = 2;

    return $SearchService->simulatePagination($perPage,$page);
}

