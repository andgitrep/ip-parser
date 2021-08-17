<?php


namespace Gruzdev\IpParser\Adapters\Interfaces;


interface ParserAdapterInterface
{
    /**
     * @param string $ip
     * @return mixed
     */
    public function parse(string $ip): bool;

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
