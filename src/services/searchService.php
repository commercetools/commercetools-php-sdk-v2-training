<?php

namespace Commercetools\Training;

include 'clientService.php';


class SearchService extends ClientService
{

    public function getAllProducts()
    {
        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->products()
            ->get()
            ->execute();
    }

    public function simulateSearch()
    {
        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->productProjections()
            ->search()
            ->get()
                ->withFilter('categories.id:"67c7ec58-0ea8-4e23-84ea-93b02e33184d"')
                ->withFacet(['variants.attributes.size','variants.attributes.color'])
                ->withFilterFacets('variants.attributes.size:256')
            ->execute();
    }

    public function simulatePagination($perPage, $page)
    {
        $apiRoot = $this->getApiClient();
        return $apiRoot->with()
            ->productProjections()
            ->get()
            ->withSort('id asc')
            ->withLimit($perPage)
            ->withOffset($perPage * ($page - 1))->execute();
    }
    
}
