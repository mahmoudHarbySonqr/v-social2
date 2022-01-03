<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Conversation extends Model {

    protected $fillable = [
        'user_id'   ,
    ];

    public function members( ) {
        return $this -> belongsToMany( user::class , 'conversation_members' ) ;
    }

    public function messages( ) {
        return $this -> hasMany( conversationMessages::class ) -> orderBy( 'created_at' , 'desc' ) ;
    }

    public function OtherUser( ) {
        return $this -> belongsTo( user::class , 'other_id' ) ;
    }

    public function scopeOther( Builder $builder ) {
        return $builder
            -> join   ( 'conversation_members as Other' , fn ( $join ) => $join
                -> on ( 'Other.conversation_id' , '='  , 'conversations.id'             )
                -> on ( 'Other.user_id'         , '!=' , 'conversation_members.user_id' )
            )
            -> Select ( [ 'Other.*' , 'Other.user_id as other_id' ] )
        ;
    }

    protected static function boot( ) {
        parent::boot( );
        static::addGlobalScope( 'members' , fn ( Builder $builder )  => $builder -> Select ( [ 'conversations.*' ] ) );
    }
}
