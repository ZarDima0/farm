<?php
namespace App\Http\Services\FarmLand;
use App\Helpers\Helpers;
use App\Http\Requests\FarmLand\DTO\CreateBuildingFarmLandDTO;
use App\Http\Requests\FarmLand\DTO\CreatePlantFarmLandDTO;
use App\Models\FarmBuilding;
use App\Models\FarmLand;
use App\Models\FarmLandPlantable;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Pagination\CursorPaginator;
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
     * @param $farmID
     * @return Builder|Model
     * @throws Exception
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

    /**
     * @param $id
     * @return CursorPaginator
     */
    public function getPlantables($id): CursorPaginator
    {
        return FarmLandPlantable::query()->where('farmland_id', $id)->cursorPaginate(10);
    }

    /**
     * @param CreatePlantFarmLandDTO $createPlantFarmLandDTO
     * @return Model|Builder
     */
    public function createPlantables(CreatePlantFarmLandDTO $createPlantFarmLandDTO): Model|Builder
    {
        return FarmLandPlantable::query()->create([
            'farmland_id' => $createPlantFarmLandDTO->getFarmlandId(),
            'plantable_type' => Helpers::convertMorpf($createPlantFarmLandDTO->getPlantableType()),
            'plantable_id' => $createPlantFarmLandDTO->getPlantableId(),
            'count' => $createPlantFarmLandDTO->getCount(),
            'planted_at' => Helpers::parseCarbon($createPlantFarmLandDTO->getPlantedAt()),
            'harvested_at' => Helpers::parseCarbon($createPlantFarmLandDTO->getHarvestedAt()),
        ]);
    }

    /**
     * @param $id
     * @param $idBuilding
     * @return Builder|object|null
     */
    public function showBuilding($id, $idBuilding): Model|Builder|null
    {
        return FarmBuilding::query()->where('farm_id',$id)->where('building_id',$idBuilding)->first();
    }

    /**
     * @param $id
     * @param $idPlantable
     * @return Model|Builder|null
     */
    public function showPlantable($id, $idPlantable): Model|Builder|null
    {
        return FarmLandPlantable::query()->where('farmland_id',$id)->where('plantable_id',$idPlantable)->first();
    }




    public function deletePlantable($id, $idPlantable)
    {
        return FarmLandPlantable::query()->where('farmland_id',$id)->where('plantable_id',$idPlantable)->delete();
    }

    public function deleteBuilding($id, $idBuilding)
    {
        return FarmBuilding::query()->where('farm_id',$id)->where('building_id',$idBuilding)->delete();
    }



    public function updatePlantable($id, $idPlantable)
    {
        return FarmLandPlantable::query()->where('farmland_id',$id)->where('plantable_id',$idPlantable)->delete();
    }

    public function updateBuilding($id, $idBuilding,$req)
    {
        $farmLand = FarmBuilding::query()->fing($idBuilding);
        $farmLand->update([$req]);
    }
}
