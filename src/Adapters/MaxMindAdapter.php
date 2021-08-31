<?php


namespace Gruzdev\IpParser\Adapters;


use GeoIp2\ProviderInterface;
use Gruzdev\IpParser\Adapters\Interfaces\ParserAdapterInterface;
use GeoIp2\Database\Reader;
use GeoIp2\Model\City;
use MaxMind\Db\Reader\InvalidDatabaseException;

class MaxMindAdapter implements ParserAdapterInterface
{

    /**
     * @var ProviderInterface
     */
    private ProviderInterface $reader;

    /**
     * MaxMindAdapter constructor.
     * @param ProviderInterface $reader
     */
    public function __construct(ProviderInterface $reader = null)
    {
        $this->reader = $reader;
    }

    /**
     * @var City
     */
    private City $record;

    /**
     * @param string $ip
     * @param ProviderInterface $reader
     * @return bool
     * @throws \Exception
     */
    public function parse(string $ip, ProviderInterface $reader = null): bool
    {
        if (empty($reader)) {
            $reader = $this->reader;
        }

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
