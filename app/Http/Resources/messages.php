<?php

namespace App\Http\Resources;

class messages extends JsonResource{
    public function toArray( $request ) { return[
        'id'         => $this -> id         ,
        'contant'    => $this -> contant    ,
        'created_at' => $this -> created_at ,
        'updated_at' => $this -> updated_at ,
        'url'        => $this -> url ,
        'User'       => new User ( $this -> User ) ,
    ] ; }

}