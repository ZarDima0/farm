<?php
namespace App\Helpers;

class Helpers
{
    protected const TREE_MORPF = 'tree';
    protected const PLANT_MORPF = 'tree';

    public function convertMorpf(string $morpf)
    {
        if($morpf == 'App\Models\Tree') {
            return self::TREE_MORPF;
        }
    }

}
