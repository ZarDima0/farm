<?php
namespace App\Http\Services\FarmLand;
use App\Models\FarmLand;

class FarmLandServices
{

    /**
     * @param $request
     * @param $user_id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function create($request, $user_id): \Illuminate\Database\Eloquent\Collection
    {
        return FarmLand::create([
            'user_id' =>$user_id,
            'name' => $request['name'],
            'tiles' => 1000,
        ]) ;
    }

    /**
     * @param int $user_id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getList(int $user_id): \Illuminate\Database\Eloquent\Collection
    {
        return FarmLand::where('user_id','=',$user_id)->get();
    }
}
