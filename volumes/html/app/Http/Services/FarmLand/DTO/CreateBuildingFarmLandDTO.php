<?php
namespace App\Http\Services\FarmLand\DTO;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Type\Integer;

class CreateBuildingFarmLandDTO
{
    /**
     * @param int $farmId
     * @param int $builderId
     */
    public function __construct(
        public int $builderId,
    )
    {
    }

    /**
     * @return string
     */
    public function getBuilderId(): string
    {
        return $this->builderId;
    }
}
