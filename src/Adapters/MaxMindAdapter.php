<?php


namespace Gruzdev\IpParser\Adapters;


use Gruzdev\IpParser\Adapters\Interfaces\ParserAdapterInterface;
use GeoIp2\Database\Reader;
use GeoIp2\Model\City;
use MaxMind\Db\Reader\InvalidDatabaseException;

class MaxMindAdapter implements ParserAdapterInterface
{

    /**
     * @var City
     */
    private City $record;
    /**
     * @var string resource_path('maxmind/GeoLite2-City.mmdb')
     */
    private string $path;

    /**
     * MaxMindAdapter constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {

        $this->path = $path;
    }


    /**
     * @param string $ip
     * @return bool
     * @throws InvalidDatabaseException
     * @throws \GeoIp2\Exception\AddressNotFoundException
     */
    public function parse(string $ip): bool
    {
            $reader = new Reader($this->path);
            $this->record = $reader->city($ip);

            return (bool) $this->record;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return (string) $this->record->country->isoCode;
    }

    /**
     * @return string
     */
    public function getCountryName(): string
    {
        return $this->record->country->name;
    }

    /**
     * @return string
     */
    public function getCityName(): string
    {
        return $this->record->city->name;
    }
}
