<?php

namespace App\Http\Resources;

class User extends JsonResource{
    public function toArray( $request ) { return[
        'id'         => $this -> id         ,
        'name'       => $this -> name       ,
        'email'      => $this -> email      ,
        'phone'      => $this -> phone      ,
        'created_at' => $this -> created_at ,
        'updated_at' => $this -> updated_at ,
        'avatar'     => $this -> url        ,
    ] ; }
}