<?php
namespace App\Http\Services\FarmLand;
use App\Helpers\Helpers;
use App\Http\Services\FarmLand\DTO\CreateBuildingFarmLandDTO;
use App\Http\Services\FarmLand\DTO\CreatePlantFarmLandDTO;
use App\Models\FarmBuilding;
use App\Models\FarmLand;
use App\Models\FarmLandPlantable;
use Exception;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FarmLandServices
{

    /**
     * Services Создание фермы
     *
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
     * Services Получение ферм пользователя
     *
     * @param int $user_id
     * @return Collection
     */
    public function getList(int $user_id): Collection
    {
        return FarmLand::query()->where('user_id', '=', $user_id)->get();
    }

    /**
     * Services Получение построек на ферме
     *
     * @param CreateBuildingFarmLandDTO $createBuildingFarmLandDTO
     */
    public function getBuildings($farmID)
    {
        return FarmBuilding::query()->where('farm_id', $farmID)->paginate(10);
    }

    /**
     * Services создание постройки на ферме
     *
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
     * Services Получение посадок на ферме
     *
     * @param $id
     * @return CursorPaginator
     */
    public function getPlantables($id): CursorPaginator
    {
        return FarmLandPlantable::query()->where('farmland_id', $id)->cursorPaginate(10);
    }

    /**
     * Services создание посадок на ферме
     *
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
     * Services отображение одной постройки
     *
     * @param $id
     * @param $idBuilding
     * @return Builder|object|null
     */
    public function showBuilding($id, $idBuilding): Model|Builder|null
    {
        return FarmBuilding::query()->where('farm_id',$id)->where('building_id',$idBuilding)->first();
    }

    /**
     * Services отображение одной посадки
     *
     *
     * @param $id
     * @param $idPlantable
     * @return Model|Builder|null
     */
    public function showPlantable($id, $idPlantable): Model|Builder|null
    {
        return FarmLandPlantable::query()->where('farmland_id',$id)->where('plantable_id',$idPlantable)->first();
    }

    /**
     * Services Удаление одной посадки с фермы
     *
     * @param $id
     * @param $idPlantable
     * @return mixed
     */
    public function deletePlantable($id, $idPlantable)
    {
        return FarmLandPlantable::query()->where('farmland_id',$id)->where('plantable_id',$idPlantable)->delete();
    }

    /**
     * Services Удаление одной постройки с фермы
     *
     * @param $id
     * @param $idBuilding
     * @return mixed
     */
    public function deleteBuilding($id, $idBuilding)
    {
        return FarmBuilding::query()->where('farm_id',$id)->where('building_id',$idBuilding)->delete();
    }

    /**
     * Services Обновление одной посадки на ферме
     *
     * @param $id
     * @param $idPlantable
     * @return mixed
     */
    public function updatePlantable($id, $idPlantable,$req)
    {
        $farmLand = FarmLandPlantable::query()->fing($idPlantable);
        $farmLand->update([$req]);
    }

    /**
     * Services Обновление одной постройки на ферме
     *
     * @param $id
     * @param $idBuilding
     * @param $req
     * @return void
     */
    public function updateBuilding($id, $idBuilding,$req)
    {
        $farmLand = FarmBuilding::query()->fing($idBuilding);
        $farmLand->update([$req]);
    }
}
