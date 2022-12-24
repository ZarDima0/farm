<?php
namespace App\Http\Controllers\User;

use App\Http\Resources\User\UserShowResource;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function show()
    {
        return new UserShowResource(User::query()->find(Auth::id()));
    }
}
