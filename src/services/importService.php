<?php

namespace Commercetools\Training;

use Commercetools\Import\Models\Importcontainers\ImportContainerDraftBuilder;

use Commercetools\Import\Models\Productdrafts\ProductDraftImportBuilder;
use Commercetools\Import\Models\Productdrafts\ProductDraftImportCollection;
use Commercetools\Import\Models\Productdrafts\ProductVariantDraftImportBuilder;

use Commercetools\Import\Models\Productdrafts\PriceDraftImportBuilder;
use Commercetools\Import\Models\Productdrafts\PriceDraftImportCollection;
use Commercetools\Import\Models\Importrequests\ProductDraftImportRequestBuilder;

use Commercetools\Import\Models\Common\MoneyBuilder;
use Commercetools\Import\Models\Common\ImageCollection;
use Commercetools\Import\Models\Common\ImageBuilder;
use Commercetools\Import\Models\Common\LocalizedStringBuilder;
use Commercetools\Import\Models\Common\ProductTypeKeyReferenceBuilder;
use Commercetools\Import\Models\Common\AssetDimensionsBuilder;



include 'clientService.php';


class ImportService extends ClientService
{

    public function createImportContainer($containerKey)
    {
        $apiRoot = $this->getImportClient();
        return $apiRoot->with()
            ->importContainers()
            ->post(
                ImportContainerDraftBuilder::of()
                    ->withKey($containerKey)
                    ->build()
            )
            ->execute();
    }

    
    public function checkImportSummary($containerKey)
    {

        $apiRoot = $this->getImportClient();
        return $apiRoot->with()
            ->importContainers()
            ->withImportContainerKeyValue($containerKey)
            ->importSummaries()
            ->get()
            ->execute();
    }
    public function importProducts($containerKey, $csvFile)
    {
        //productDraftImportBuilder
        //productDraftImportCollection
        //ProductDraftImportRequestBuilder
        //ProductDraftImportRequestCollection
        //ProductDraftImportRequest via clientBuilder
        $productDraftImportCollection = $this->createImportProductDraftCollection($csvFile);
        $productDraftImportRequest= ProductDraftImportRequestBuilder::of()
            ->withResources(
                $productDraftImportCollection
            )
            ->build();
        
        $apiRoot = $this->getImportClient();
        
        return $apiRoot->with()
            ->productDrafts()
            ->importContainers()
            ->withImportContainerKeyValue($containerKey)
            ->post($productDraftImportRequest)
            ->execute();
    }
    public function createImportProductDraftCollection($csvFile)
    {   
        $participantNamePrefix = 'nd-';
        $productDataArray = $this->readDataFromCSV($csvFile);
        
        $productCollection = ProductDraftImportCollection::of();
        for ($x = 1; $x < count($productDataArray); $x++) {
            $productCollection = $productCollection->add(
                ProductDraftImportBuilder::of()
                ->withProductType(
                    ProductTypeKeyReferenceBuilder::of()->withKey($productDataArray[$x][0])->build()
                )
                ->withKey($participantNamePrefix.$productDataArray[$x][4])
                ->withName(
                    LocalizedStringBuilder::of()->put('en',$participantNamePrefix.$productDataArray[$x][4])->build()
                )
                ->withSlug(
                    LocalizedStringBuilder::of()->put('en',$participantNamePrefix.$productDataArray[$x][4])->build()
                )
                ->withDescription(
                    LocalizedStringBuilder::of()->put('en',$participantNamePrefix.$productDataArray[$x][5])->build()
                )
                ->withMasterVariant(
                        ProductVariantDraftImportBuilder::of()
                        ->withSku($participantNamePrefix.$productDataArray[$x][2])
                        ->withKey($participantNamePrefix.$productDataArray[$x][2])
                        ->withPrices(
                            PriceDraftImportCollection::of()->add(
                                PriceDraftImportBuilder::of()
                                ->withValue(MoneyBuilder::of()
                                            ->withCentAmount($productDataArray[$x][6])
                                            ->withCurrencyCode($productDataArray[$x][7])
                                            ->build()
                                            
                                            )
                                ->build()
                            )
                        )
                        ->withImages(
                            ImageCollection::of()
                            ->add(
                                ImageBuilder::of()->withUrl($productDataArray[$x][8])
                                ->withDimensions(AssetDimensionsBuilder::of()->withW(177)->withH(237)->build())
                                ->build()
                            )
                        )->build()
                )->build()
            );

          }
        return $productCollection;
    }

    public function readDataFromCSV($file)
    {
        $dataArray = [];
        $f_pointer=fopen($file,"r"); // file pointer

        while(! feof($f_pointer)){
            $ar=fgetcsv($f_pointer);
            array_push($dataArray,$ar);
        }
        return $dataArray;
    }
}
