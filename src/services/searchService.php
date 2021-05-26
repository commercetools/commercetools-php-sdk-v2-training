<?php

namespace Commercetools\Training;
include 'clientService.php';


class SearchService extends ClientService
{

    public function getAllProducts()
    {

        $builder = $this->getApiBuilder();
        $request = $builder->with()->products()->get();
        $response = $request->execute();
        return $response;
    }

    public function simulateSearch()
    {

        $builder = $this->getApiBuilder();
        $request = $builder->with()->productProjections()->search()->get()
        ->withFilter('categories.id:"67c7ec58-0ea8-4e23-84ea-93b02e33184d"')
        ->withFacet(['variants.attributes.size','variants.attributes.color'])
        ->withFilterFacets('variants.attributes.size:256');
        $response = $request->execute();
        return $response;
    }
    public function simulatePagination($perPage, $page)
    {

        $builder = $this->getApiBuilder();
        $request = $builder->with()->productProjections()->get()->withLimit($perPage)->withOffset($perPage * ($page - 1));
        $response = $request->execute();
        return $response;
    }
    
}
