<?php
namespace App\Http\Services\FarmLand;
use App\Models\FarmLand;

class FarmLandServices
{


    /**
     * @param $name
     * @param $user_id
     */
    public function create($name, $user_id)
    {
        return FarmLand::query()->create([
            'user_id' =>$user_id,
            'name' => $name,
            'tiles' => 1000,
        ]) ;
    }

    /**
     * @param int $user_id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getList(int $user_id): \Illuminate\Database\Eloquent\Collection
    {
        return FarmLand::query()->where('user_id','=',$user_id)->get();
    }
}
