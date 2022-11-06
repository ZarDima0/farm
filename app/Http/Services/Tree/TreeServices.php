<?php
namespace App\Http\Services\Tree;

use App\Models\Tree;

class TreeServices
{
    public function getList()
    {
        return Tree::all();
    }
}
