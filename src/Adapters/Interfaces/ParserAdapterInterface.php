<?php


namespace Gruzdev\IpParser\Adapters\Interfaces;


use GeoIp2\ProviderInterface;

interface ParserAdapterInterface
{
    /**
     * @param string $ip
     * @param ProviderInterface $reader
     * @return mixed
     */
    public function parse(string $ip, ProviderInterface $reader): bool;

    /**
     * @return string
     */
    public function getCountryCode(): string;

    /**
     * @return string
     */
    public function getCountryName(): string;

    /**
     * @return string
     */
    public function getCityName(): string;


}
