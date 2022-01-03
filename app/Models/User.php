<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Traits\StorageTraits;
use Illuminate\Http\UploadedFile ;

class User extends Authenticatable {

    use
        HasApiTokens ,
        HasFactory   ,
        HasRoles     ,
        StorageTraits,
        Notifiable
    ;

    protected $fillable = [
        'name'     ,
        'email'    ,
        'phone'    ,
        'password' ,
    ];

    protected $hidden = [ 'password' ];

    public function getToken( ) : array { return [
        'token_type'    => 'Bearer'                                     ,
        'expires_in'    => null                                         ,
        'refresh_token' => null                                         ,
        'access_token'  => $this -> createToken( '' ) -> plainTextToken ,
    ] ; }


    public function Conversations( ) {
        return $this
            -> belongsToMany( Conversation::class , 'conversation_members' )
            -> Other( )
        ;
    }

    public function getUrlColumnNameAttributeStorageTraits( ) :? string {
        return $this -> avatar ;
    }

    public function getTokensFireBaseIdAttribute( ) : array {
        return $this -> tokens( ) -> pluck( 'fireBaseId' ) -> filter( ) -> values( ) -> toArray( ) ;
    }

    public function getNameAllAttribute( ) : string {
        return $this -> name ?? $this -> email ?? $this -> phone ;
    }

    public function saveInDataBase( UploadedFile $Avatar ) : string {
        $this -> avatar = $this -> getHashPath( $Avatar ) ;
        $this -> save( ) ;
        return $this -> refresh( ) ;
    }

    public function edit( array $attrs = [ ] ) : self {
        if( $attrs[ 'password'   ] ?? null ) $attrs[ 'password' ] = \Hash ::  make ( $attrs[ 'password'   ] ) ;
        if( $attrs[ 'avatar'     ] ?? null ) $this -> saveInDataBase     (                     $attrs[ 'avatar'     ] ) ;
        if( $attrs[ 'fireBaseId' ] ?? null ) $this -> currentAccessToken ( ) -> setFireBaseId( $attrs[ 'fireBaseId' ] ) ;
        $this -> update( $attrs ) ;
        return $this ;
    }

}