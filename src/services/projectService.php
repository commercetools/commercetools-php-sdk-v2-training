<?php

namespace Commercetools\Training;
use Commercetools\Api\Models\Project\ProjectBuilder;

include 'clientService.php';


class ProjectService extends ClientService
{

    public function getProjectSettings()
    {
        return ProjectBuilder::of();
    }
}
