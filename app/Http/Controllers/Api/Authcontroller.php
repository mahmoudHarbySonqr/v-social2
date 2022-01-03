<?php

namespace App\Http\Controllers\Api;

use Hash ;
use Auth ;

use App\Models\User ;
use Illuminate\Http\Response ;
use App\Http\Controllers\Controller ;
use App\Http\Requests\Api\loginApiRequest ;
use App\Http\Requests\Api\AuthUpdateApiRequest ;
use App\Http\Resources\User as UserResources ;

class Authcontroller extends Controller {
    public function login( loginApiRequest $request , ? User $user ) {
        if ( $request -> get( 'email' , false ) ) $user = User::where( 'email' , $request -> get( 'email' ) ) -> first( ) ;
        if ( $request -> get( 'phone' , false ) ) $user = User::where( 'phone' , $request -> get( 'phone' ) ) -> first( ) ;
        if ( $user && ! Hash::check( $request -> password , $user -> password ) ) return $this -> MakeResponseErrors( [ 'auth' => [ 'InvalidCredentials' ] ] , 'InvalidCredentials' , Response::HTTP_UNAUTHORIZED ) ;
        return $this -> MakeResponseSuccessful( [
            'user'  => new UserResources ( $user ) ,
            'Token' => $user -> getToken( ) ,
        ] ) ;
    }
    public function me( ) : UserResources {
        return new UserResources ( Auth::guard( 'sanctum' ) -> user( ) ) ;
    }
    public function update( AuthUpdateApiRequest $request ) : UserResources {
        $asdsa = ( $user = Auth::guard( 'sanctum' ) -> user( ) ) -> edit( $request -> all( ) ) ;
        return new UserResources ( Auth::guard( 'sanctum' ) -> user( ) ) ;
    }
}
