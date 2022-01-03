<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

use Auth ;

class AuthUpdateApiRequest extends FormRequest {
    public function rules( ) { return [
        'name'       => [ 'nullable' , 'unique:users,name,' , 'max:50'                  ] ,
        'phone'      => [ 'nullable' , 'unique:users,phone,' , 'max:15'                 ] ,
        'password'   => [ 'nullable' , Password::min( 8 ) -> mixedCase( ) -> numbers( ) ] ,
        'avatar'     => [ 'nullable' , 'mimes:jpg,jpeg,png' , 'max:5000'                ] ,
        'fireBaseId' => [ 'nullable' , 'unique:users,phone,' , 'max:15'                 ] ,
    ]; }
}
