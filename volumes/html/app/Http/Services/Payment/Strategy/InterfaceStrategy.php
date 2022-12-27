<?php
namespace App\Http\Services\Payment\Strategy;

interface InterfaceStrategy
{
    /**
     * @param int $valueGem
     * @return mixed
     */
    public function doService(int $valueGem);
}
