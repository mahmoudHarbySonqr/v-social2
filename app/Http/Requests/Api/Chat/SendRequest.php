<?php

namespace App\Http\Requests\Api\Chat;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

use Auth ;

class SendRequest extends FormRequest {
    public function authorize( ) : bool {
        return Auth::check( ) ;
    }

    public function rules( ) { return [
        'user_id' => [ 'required' , 'numeric'                , 'exists:users,id' ] ,
        'contant' => [ 'nullable' , 'string'                 , 'max:190'         ] ,
        'file'    => [ 'nullable' , 'mimes:jpg,jpeg,png,mp4' , 'max:5000'        ] ,
    ]; }
}
