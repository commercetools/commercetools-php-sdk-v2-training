<?php

namespace Commercetools\Training;
use Commercetools\Import\Models\Importsinks\ImportSink;
use Commercetools\Import\Models\Importsinks\ImportSinkDraftBuilder;
use Commercetools\Import\Models\Productdrafts\ProductDraftImportBuilder;
use Commercetools\Import\Models\Productdrafts\ProductDraftImportCollection;
use Commercetools\Import\Models\Productdrafts\ProductVariantDraftImportBuilder;
use Commercetools\Import\Models\Productdrafts\ProductVariantDraftImportCollection;
use Commercetools\Import\Models\Productdrafts\PriceDraftImportBuilder;
use Commercetools\Import\Models\Productdrafts\PriceDraftImportCollection;
use Commercetools\Import\Models\Importrequests\ProductDraftImportRequestBuilder;
use Commercetools\Import\Models\Importrequests\ProductDraftImportRequestCollection;

use Commercetools\Api\Models\Common\CentPrecisionMoneyDraftBuilder;

use Commercetools\Import\Models\Common\TypedMoneyBuilder;
use Commercetools\Import\Models\Common\ImageCollection;
use Commercetools\Import\Models\Common\ImageBuilder;
use Commercetools\Import\Models\Common\LocalizedStringBuilder;
use Commercetools\Import\Models\Common\ProductTypeKeyReferenceBuilder;
use Commercetools\Import\Models\Common\AssetDimensionsBuilder;



include 'clientService.php';


class ImportService extends ClientService
{

    public function createImportSink()
    {

        $builder = $this->getImportBuilder();
        $response = $builder->with()->importSinks()->post(
            ImportSinkDraftBuilder::of()->withKey('ff-testSink')->withResourceType('product-draft')->build()
        )->execute();
        return $response;
    }

    //not yet finished
    public function checkImportSinkOperationStatusWithId($importSinkKey, $operationId)
    {

        $builder = $this->getImportBuilder();
        $request = $builder->with()->customers()->get();
        $response = $request->execute();
        return $response;
    }
    public function importProducts()
    {
        //productDraftImportBuilder
        //productDraftImportCollection
        //ProductDraftImportRequestBuilder
        //ProductDraftImportRequestCollection
        //ProductDraftImportRequest via clientBuilder
        $productDraftImportCollection = $this->createImportProductDraftCollection();
        $productDraftImportRequest= ProductDraftImportRequestBuilder::of()->withResources($productDraftImportCollection)->build();
        $ProductDraftImportRequestCollection = ProductDraftImportRequestCollection::of()->add($productDraftImportRequest);
        $builder = $this->getImportBuilder();
        $response = $builder->with()->productDrafts()->importSinkKeyWithImportSinkKeyValue('ff-testSink')->post($productDraftImportRequest)->execute();
        return $response;

    }
    public function createImportProductDraftCollection()
    {   
        $participantNamePrefix = 'ff-';
        $productDataArray = $this->readDataFromCSV();
        
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
                                ->withValue(TypedMoneyBuilder::of()
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

    public function readDataFromCSV()
    {
        $dataArray = [];
        $f_pointer=fopen("././products.csv","r"); // file pointer

        while(! feof($f_pointer)){
        $ar=fgetcsv($f_pointer);
        array_push($dataArray,$ar);
        }
        return $dataArray;
    }
}
