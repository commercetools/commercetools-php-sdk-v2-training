<?php
namespace Commercetools\Training;

include 'services/projectService.php';


print_r(getProjectSettings());

function getProjectSettings()
{
    $project = new ProjectService();
  
    return $project->getProjectSettings();
}
