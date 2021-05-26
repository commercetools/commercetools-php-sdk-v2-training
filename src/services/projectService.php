<?php

namespace Commercetools\Training;

include 'clientService.php';


class ProjectService extends ClientService
{

    public function getProjectSettings()
    {

        $builder = $this->getApiBuilder();
        
        $request = $builder->with()->get();
        $response = $request->execute(); 
        return $response;
    }

    
}
