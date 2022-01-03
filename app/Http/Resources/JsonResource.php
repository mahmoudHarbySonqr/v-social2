<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse ;
use Illuminate\Http\Resources\Json\JsonResource as Resources;

Abstract class JsonResource extends Resources{
    public string $message ;
    public bool   $check   ;
    public int    $code    ;

    public function __construct( $resource , string $message = 'Successful.' , bool $check = true , int $code = JsonResponse::HTTP_OK ) {
        parent::__construct( $resource );
        $this -> message = $message ;
        $this -> check   = $check   ;
        $this -> code    = $code    ;
    }

    public function with( $request ) {
        return [
            'message' => $this -> message ,
            'check'   => $this -> check   ,
        ];
    }
}