<?php


namespace App\Services\IpParser;


use App\Services\IpParser\Adapters\Interfaces\ParserAdapterInterface;
use App\Services\IpParser\Interfaces\IpParserServiceInterface;
use App\Services\IpParser\Repositories\Interfaces\IpParserRepositoryInterface;

class IpParserService implements IpParserServiceInterface
{

    /**
     * @var ParserAdapterInterface
     */
    private ParserAdapterInterface $parserAdapter;

    private string $ip;

    /**
     * IpParserService constructor.
     * @param ParserAdapterInterface $parserAdapter
     */
    public function __construct(ParserAdapterInterface $parserAdapter)
    {
        $this->parserAdapter = $parserAdapter;
    }

    /**
     * @param string $ip
     * @return bool
     */
    public function parse(string $ip): bool
    {
        $this->ip = $ip;
        try {
            $this->parserAdapter->parse($ip);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return $this->parserAdapter->getCountryCode();
    }

    /**
     * @return string
     */
    public function getCountryName(): string
    {
        return $this->parserAdapter->getCountryName();
    }

    /**
     * @return string
     */
    public function getCityName(): string
    {
        return $this->parserAdapter->getCityName();
    }


}
