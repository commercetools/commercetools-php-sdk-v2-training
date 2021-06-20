<?php

namespace Commercetools\Training;

use Commercetools\Api\Client\ClientCredentialsConfig;
use Commercetools\Api\Client\Config;
use Commercetools\Client\ClientCredentials;
use Commercetools\Client\ClientFactory;
use Commercetools\Client\ApiRequestBuilder;
use Commercetools\Client\ImportRequestBuilder;
use Dotenv\Dotenv;

require __DIR__.'/../../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__.'/../../');
$dotenv->load();

class ClientService {
    private static $client;
    private static $projectKey;

    public function getApiClient()
    {
        if (is_null(self::$client)) {
            $clientId = $_ENV['CTP_CLIENT_ID'] ?? '';
            $clientSecret = $_ENV['CTP_CLIENT_SECRET'] ?? '';
            self::$projectKey = $_ENV['CTP_PROJECT'] ?? '';
            $authConfig = new ClientCredentialsConfig(new ClientCredentials($clientId, $clientSecret));

            $client = ClientFactory::of()->createGuzzleClient(
                new Config(),
                $authConfig
            );
            self::$client = $client;

        }
        return self::$client;
    }
    public function getImportClient(){
        if (is_null(self::$client)) {
            $clientId = $_ENV['CTP_CLIENT_ID'] ?? '';
            $clientSecret = $_ENV['CTP_CLIENT_SECRET'] ?? '';
            self::$projectKey = $_ENV['CTP_PROJECT'] ?? '';
            $authConfig = new ClientCredentialsConfig(new ClientCredentials($clientId, $clientSecret));

            $client = ClientFactory::of()->createGuzzleClient(
                new \Commercetools\Import\Client\Config(),
                $authConfig
            );
            self::$client = $client;

        }
        return self::$client;
    }
    public function getStoreClient()
    {
        if (is_null(self::$client)) {
            $clientId = $_ENV['CTP_STORE_ID'] ?? '';
            $clientSecret = $_ENV['CTP_STORE_SECRET'] ?? '';
            self::$projectKey = $_ENV['CTP_PROJECT'] ?? '';
            $authConfig = new ClientCredentialsConfig(new ClientCredentials($clientId, $clientSecret));

            $client = ClientFactory::of()->createGuzzleClient(
                new Config(),
                $authConfig
            );
            self::$client = $client;

        }
        return self::$client;
    }
    public function getApiBuilder()
    {
        $client = $this->getApiClient();
        return new ApiRequestBuilder(self::$projectKey, $client);
    }
    public function getImportBuilder()
    {
        $client = $this->getImportClient();
        return new ImportRequestBuilder(self::$projectKey, $client);
    }
    public function getStoreBuilder()
    {
        $client = $this->getStoreClient();
        return new ApiRequestBuilder(self::$projectKey, $client);
    }
    
}