<?php

namespace App\Http\Resources;

class Conversation extends JsonResource{
    public function toArray( $request ) { return[
        'id'           => $this -> id     ,
        'last_message' => new messages ( $this -> messages( ) -> first( ) ) ,
        'others'       => User::collection( $this -> members -> whereNotIn( 'id' , [ \Auth::id( ) ] ) ) ,
    ] ; }
}