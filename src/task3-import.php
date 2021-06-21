<?php
namespace Commercetools\Training;

include 'services/importService.php';

$importService = new ImportService();
print_r($importService->checkImportSinkOperationStatusWithId('ff-testSink','e350c952-38ad-4ded-b100-ae886a54f172'));

//https://github.com/commercetools/commercetools-project-sync#run
// docker run \
// -e SOURCE_PROJECT_KEY= \
// -e SOURCE_CLIENT_ID= \
// -e SOURCE_CLIENT_SECRET= \
// -e TARGET_PROJECT_KEY= \
// -e TARGET_CLIENT_ID= \
// -e TARGET_CLIENT_SECRET= \
// commercetools/commercetools-project-sync:3.10.1 -s all