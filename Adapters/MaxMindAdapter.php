<?php


namespace App\Services\IpParser\Adapters;


use App\Services\IpParser\Adapters\Interfaces\ParserAdapterInterface;
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
     * @param string $ip
     * @throws InvalidDatabaseException
     * @throws \GeoIp2\Exception\AddressNotFoundException
     */
    public function parse(string $ip): bool
    {
            $reader = new Reader(resource_path('maxmind/GeoLite2-City.mmdb'));
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
