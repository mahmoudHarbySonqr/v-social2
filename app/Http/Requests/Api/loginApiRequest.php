<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class loginApiRequest extends FormRequest {

    public function rules( ) {
        return [
            'email'    => [ 'required_without:phone' , 'email:rfc' , 'exists:users' ] ,
            'phone'    => [ 'required_without:email' , 'string'    , 'exists:users' ] ,
            'password' => [ 'required' , Password::min( 8 ) -> mixedCase( ) -> numbers( ) ]
        ];
    }
}
