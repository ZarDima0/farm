<?php
namespace App\Http\Controllers\Tree;

use App\Http\Controllers\Controller;
use App\Http\Requests\FarmLand\FarmLandCreateRequest;
use App\Http\Requests\Tree\TreeGetRequest;
use App\Http\Resources\FarmLand\FarmLandResource;
use App\Http\Resources\Tree\TreeResource;
use App\Http\Services\FarmLand\FarmLandServices;
use App\Http\Services\Tree\TreeServices;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class TreeController extends Controller
{

    /**
     * @param TreeGetRequest $request
     * @param TreeServices $treeServices
     * @return TreeResource
     */
    public function getList(TreeGetRequest $request, TreeServices $treeServices): AnonymousResourceCollection
    {
        return TreeResource::collection($treeServices->getList());
    }
}
