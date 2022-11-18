<?php
namespace App\Helpers;

use Carbon\Carbon;

class Helpers
{
    protected const PLANT = 'App\Models\Plant';
    protected const TREE = 'App\Models\Tree';

    protected const TREE_MORPF = 'tree';
    protected const PLANT_MORPF = 'plant';

    /**
     * @param string $morpf
     * @return string
     */
    public static function convertMorpf(string $morpf): string
    {
        if ($morpf == self::PLANT) {
            return self::PLANT_MORPF;
        }

        if ($morpf == self::TREE) {
            return self::TREE_MORPF;
        }

        if ($morpf == self::TREE_MORPF) {
            return self::TREE;
        }

        if ($morpf == self::PLANT_MORPF) {
            return self::PLANT;
        }
    }

    /**
     * @param string $date
     * @return Carbon
     */
    public static function parseCarbon(string $date): Carbon
    {
        return Carbon::parse($date);
    }
}
