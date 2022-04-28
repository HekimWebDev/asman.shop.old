<?php

namespace App\Services\LogoTiger;

use App\Services\LogoTiger\Requests\HasCategoriesRequests;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use App\Services\LogoTiger\Requests\HasUnitsRequests;
use GuzzleHttp\Psr7\Request;

use App\Services\LogoTiger\Requests\HasBarcodesRequests;
use App\Services\LogoTiger\Requests\HasBrandsRequests;
use App\Services\LogoTiger\Requests\HasCurrenciesRequests;
use App\Services\LogoTiger\Requests\HasDivisionsRequests;
use App\Services\LogoTiger\Requests\HasExchangesRequests;
use App\Services\LogoTiger\Requests\HasItemsRequests;
use App\Services\LogoTiger\Requests\HasPricesRequests;
use App\Services\LogoTiger\Requests\HasWarehouseRequests;
use Illuminate\Support\Facades\Storage;

class TigerService
{
    use HasUnitsRequests;
    use HasBrandsRequests;
    use HasCategoriesRequests;
    use HasBarcodesRequests;
    use HasCurrenciesRequests;
    use HasDivisionsRequests;
    use HasExchangesRequests;
    use HasItemsRequests;
    use HasPricesRequests;
    use HasWarehouseRequests;

    protected $url;
    protected $request;
    protected $response;
    protected $client;
    protected $dto;
    protected $testing;

    public function __construct($testing = false)
    {
        $this->url = config('tiger.api');
        $this->testing = $testing;
        $this->client = $this->client();
    }

    public function client($handlerStack = null): GuzzleClient
    {
        return new GuzzleClient([
            'auth' => config('tiger.auth'),
            // 'debug'    => true,
            'base_uri' => $this->url,
            'handler' => $handlerStack,
            'defaults' => [
                'exception' => false,
            ],
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'curl' => [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
            ]
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function send($method = 'GET', $body = null): static
    {
        $this->request = new Request($method, $this->url, [], $body);
        $response = $this->client->send($this->request);
        $this->response = new Response($response, $this->dto);
        return $this;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function addPath(string $endpoint): self
    {
        $this->url .= "/$endpoint?";
        return $this;
    }

    public function addParams(array $params): self
    {
        foreach ($params as $key => $value) {
            $this->url .= "{$key}={$value}&";
        }

        return $this;
    }

    public function setDTO(string $classPath)
    {
        $this->dto = $classPath;
        return $this;
    }

    public function include(array $include)
    {
        foreach ($include as $key => $value) {
            $this->addParams([
                'include' => $value
            ]);
        }

        return $this;
    }

    public function limit(int $limit)
    {
        $this->addParams([
            'limit' => $limit
        ]);

        return $this;
    }

    public function offset(int $limit)
    {
        $this->addParams([
            'offset' => $limit
        ]);
        return $this;
    }

    public function withDefaultParams()
    {
        return $this->addParams(['firmNr' => 2]);
    }

    public function isTesting(): bool
    {
        return $this->testing;
    }

    public function setClientWithMockData(string $dataName): self
    {
        $mock = new MockHandler([
            new GuzzleResponse(200, ['X-Foo' => 'Bar'], file_get_contents(__DIR__ . '/TestData/' . $dataName . '.json'))
        ]);

        $this->client = $this->client(HandlerStack::create($mock));

        return $this;
    }

    public function saveData($name): static
    {
        $file = $this->response;
//        dd($name, $file->toDto()->asCollection());
        Storage::disk('tiger')->put($name . '.json', $file->toDto()->asCollection());
        return $this;
    }
}
