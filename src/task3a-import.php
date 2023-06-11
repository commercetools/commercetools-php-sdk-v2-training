<?php
namespace Commercetools\Training;
use Commercetools\Import\Models\Importsummaries\ImportSummaryCollection;

include 'services/importService.php';

$containerKey = 'nd-import-products';
$csvFile = '././products.csv';

print_r(createImportContainer($containerKey));

function createImportContainer($containerKey)
{
    $importService = new ImportService();

    return $importService->createImportContainer($containerKey);
}

function importProducts($containerKey, $csvFile)
{
    $importService = new ImportService();

    return $importService->importProducts($containerKey, $csvFile);
}

function checkImportSummary($containerKey)
{
    $importService = new ImportService();

    return ($importService->checkImportSummary($containerKey))
        ->getStates()
        ->jsonSerialize();
}



