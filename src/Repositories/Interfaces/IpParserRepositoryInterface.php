<?php


namespace App\Services\IpParser\Repositories\Interfaces;


use App\Models\Link;

interface IpParserRepositoryInterface
{
    /**
     * @param array $data
     * @param Link $link
     * @return bool
     */
    public function save(array $data, Link $link): bool;
}
