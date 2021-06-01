<?php
namespace Commercetools\Training;

include 'services/importService.php';

$importService = new ImportService();
print_r($importService->checkImportSinkOperationStatusWithId('ff-testSink','e350c952-38ad-4ded-b100-ae886a54f172'));