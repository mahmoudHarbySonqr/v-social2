<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as Model ;

class PersonalAccessToken extends Model {
    
    public function setFireBaseId( string $FireBaseId ) : self {
        $this -> FireBaseId = $FireBaseId;
        $this -> save( ) ;
        return $this -> refresh( ) ;
    }

}
