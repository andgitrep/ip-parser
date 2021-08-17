<?php


namespace App\Services\IpParser\Repositories;


use App\Models\Link;
use App\Models\Statistic;
use App\Services\IpParser\Interfaces\IpParserServiceInterface;
use App\Services\IpParser\Repositories\Interfaces\IpParserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class IpParserRepository implements IpParserRepositoryInterface
{

    /**
     * @param array $data
     * @param Link $link
     * @return bool
     * @throws \Exception
     */
    public function save(array $data, Link $link): bool
    {
        $stat = new Statistic();
        $stat->ip = $data['ip'];
        $stat->link_id = $link->id;
        $stat->country_code = $data['country_code'];
        $stat->country_name = $data['country_name'];
        $stat->city_name = $data['city_name'];


        DB::beginTransaction();

        try {
            $stat->save();
            $link->clicks++;
            $link->save();

        } catch(\Exception $e)
        {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return true;
    }
}
