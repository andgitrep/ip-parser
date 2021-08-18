<?php


namespace Gruzdev\IpParser\Interfaces;


use GeoIp2\ProviderInterface;

interface IpParserServiceInterface
{
    /**
     * @param string $ip
     * @param ProviderInterface $reader
     * @return bool
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
