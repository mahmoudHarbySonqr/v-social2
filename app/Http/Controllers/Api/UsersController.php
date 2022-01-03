<?php

namespace App\Http\Controllers\Api;

use Auth ;
use App\Models\User ;
use Illuminate\Http\Request ;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserConversation as UserResources;

class UsersController extends Controller {
    public function All( Request $Request ) {
        return UserResources::collection( User::All( ) ) ;
    }
}
