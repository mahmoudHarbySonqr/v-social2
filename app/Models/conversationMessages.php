<?php

namespace App\Models;

use App\Events\NewMessage;

class conversationMessages extends Model {

    protected $fillable = [
        'user_id'         ,
        'contant'         ,
        'conversation_id' ,
        'hash'            ,
    ];

    public function User( ) {
        return $this -> belongsTo( user::class ) ;
    }

    public function Conversation( ) {
        return $this -> belongsTo( Conversation::class ) ;
    }

    public function edit( array $attrs = [ ] ) : self {
        if( $attrs[ 'file' ] ) $attrs[ 'file' ] = $this -> saveInDataBase ( $attrs[ 'file' ] ) ;
        $this -> update( $attrs ) ;
        return $this ;
    }

    protected static function boot( ) {
        parent::boot( );
        static::created( fn ( conversationMessages $Messages ) => broadcast( new NewMessage( $Messages ) ) -> toOthers( ) );
    }

}
