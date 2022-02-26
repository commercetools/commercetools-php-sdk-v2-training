<?php
namespace Commercetools\Training;

include 'services/importService.php';

$importService = new ImportService();
print_r($importService->checkImportSummary('ff-testSink-1'));