<?php
namespace App\Http\Services\FarmLand;
use App\Http\Requests\FarmLand\DTO\CreateBuildingFarmLandDTO;
use App\Http\Requests\FarmLand\DTO\CreatePlantFarmLandDTO;
use App\Models\FarmBuilding;
use App\Models\FarmLand;
use App\Models\FarmLandPlantable;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FarmLandServices
{

    /**
     * @param $name
     * @param $user_id
     */
    public function create($name, $user_id)
    {
        return FarmLand::query()->create([
            'user_id' => $user_id,
            'name' => $name,
            'tiles' => 1000,
        ]);
    }

    /**
     * @param int $user_id
     * @return Collection
     */
    public function getList(int $user_id): Collection
    {
        return FarmLand::query()->where('user_id', '=', $user_id)->get();
    }

    /**
     * @param CreateBuildingFarmLandDTO $createBuildingFarmLandDTO
     */
    public function getBuildings($farmID)
    {
        return FarmBuilding::query()->where('farm_id', $farmID)->paginate(10);
    }

    /**
     * @param CreateBuildingFarmLandDTO $createBuildingFarmLandDTO
     */
    public function createBuildings(CreateBuildingFarmLandDTO $createBuildingFarmLandDTO, $farmID): Builder|Model
    {
        if (!isset($farmID)) {
            throw new Exception('Нет id фермы');
        }

        return FarmBuilding::query()->create([
            'farm_id' => $farmID,
            'building_id' => $createBuildingFarmLandDTO->getBuilderId(),
        ]);
    }

    public function getPlantables()
    {
    }

    public function createPlantables(CreatePlantFarmLandDTO $createPlantFarmLandDTO)
    {
        dd($createPlantFarmLandDTO);
    }
}
