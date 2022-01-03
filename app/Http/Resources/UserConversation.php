<?php

namespace App\Http\Resources;

class UserConversation extends JsonResource{
    public function toArray( $request ) { return[
        'id'           => $this -> id         ,
        'name'         => $this -> name       ,
        'email'        => $this -> email      ,
        'phone'        => $this -> phone      ,
        'created_at'   => $this -> created_at ,
        'updated_at'   => $this -> updated_at ,
        'avatar'       => $this -> url        ,
        'Conversation' => new Conversation ( \Auth::user( ) -> Conversations( ) -> where( 'Other.user_id' , $this -> id ) -> first( ) ) ,
    ] ; }
}