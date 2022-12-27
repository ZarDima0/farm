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
        return match($morpf) {
            self::PLANT => self::PLANT_MORPF,
            self::TREE => self::TREE_MORPF,
            self::PLANT_MORPF => self::PLANT,
            self::TREE_MORPF => self::TREE,
        };
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
