<?php
namespace App\Http\Services\Payment\Strategy;

class Context
{
    private InterfaceStrategy $interfaceStrategy;

    /**
     * @param InterfaceStrategy $interfaceStrategy
     */
    public function __construct(InterfaceStrategy $interfaceStrategy)
    {
        $this->interfaceStrategy = $interfaceStrategy;
    }

    /**
     * @param $valueGem
     * @return void
     */
    public function startService($valueGem)
    {
        return $this->interfaceStrategy->doService($valueGem);
    }
}
