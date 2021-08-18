<?php


namespace Gruzdev\IpParser\Adapters;


use GeoIp2\ProviderInterface;
use Gruzdev\IpParser\Adapters\Interfaces\ParserAdapterInterface;
use Illuminate\Support\Facades\Http;

/**
 * Class IpApiAdapter
 * @package App\Services\IpParser\Adapters
 */
class IpApiAdapter implements ParserAdapterInterface
{

    /**
     * @var string
     */
    private const URL = 'http://ip-api.com/json/';

    /**
     * @var array
     */
    private array $response;

    /**
     * @param string $ip
     * @param ProviderInterface|null $reader
     * @return bool
     * @throws \Exception
     */
    public function parse(string $ip, ProviderInterface $reader = null): bool
    {
            $this->response = HTTP::get(self::URL . $ip)->json();
            if(!($this->response) || $this->response['status'] === "fail") {
                throw new \Exception();
            }

            return (bool) $this->response;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->response['countryCode'];
    }

    /**
     * @return string
     */
    public function getCountryName(): string
    {
        return $this->response['country'];
    }

    /**
     * @return string
     */
    public function getCityName(): string
    {
        return $this->response['city'];
    }
}
