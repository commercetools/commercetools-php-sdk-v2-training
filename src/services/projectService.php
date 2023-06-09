<?php

namespace Commercetools\Training;

include 'clientService.php';


class ProjectService extends ClientService
{

    public function getProjectSettings()
    {
        $apiRoot = $this->getApiClient();
        
        return $apiRoot->with()
            ->get()
            ->execute();
    }
}
