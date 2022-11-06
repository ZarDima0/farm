<?php
namespace App\Http\Controllers\FarmLand;

use App\Http\Controllers\Controller;
use App\Http\Requests\FarmLand\FarmLandCreateRequest;
use App\Http\Resources\FarmLand\FarmLandResource;
use App\Http\Services\FarmLand\FarmLandServices;
use Illuminate\Support\Facades\Auth;

class FarmLandController extends Controller
{
    /**
     * @param FarmLandCreateRequest $request
     * @param FarmLandServices $FarmLandServices
     * @return FarmLandResource
     */
    public function create(FarmLandCreateRequest $request, FarmLandServices $FarmLandServices): FarmLandResource
    {
        return new FarmLandResource($FarmLandServices->create($request, Auth::id()));
    }

    /**
     * @param FarmLandServices $FarmLandServices
     * @return FarmLandResource
     */
    public function getList(FarmLandServices $FarmLandServices): FarmLandResource
    {
        return new FarmLandResource($FarmLandServices->getList(Auth::id()));
    }
}
