<?php
namespace Commercetools\Training;

include 'services/importService.php';

$importService = new ImportService();
print_r($importService->importProducts());