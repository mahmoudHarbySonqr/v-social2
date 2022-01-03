<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\conversationMessages;
use App\Models\User;

class StorageController extends Controller {
    public function User( string $Hash ) {
        return User::GetByHash( str_replace( '|' , '/' , $Hash ) ) ;
    }
    public function conversationMessages( string $Hash ) {
        return conversationMessages::GetByHash( str_replace( '|' , '/' , $Hash ) ) ;
    }
}
