<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name( 'v1.') -> prefix( 'v1' ) -> group( fn ( ) => [
    Route::prefix( 'magic' ) -> group( fn ( ) => [
        Route::post( '/create/{email}/{password?}' , fn( string $email , string $password = 'password1A' ) => response( ) -> json( [
            'user'  => $User = App\Models\User::where( [ 'email' => $email ] ) -> first( ) ?? App\Models\User::create( [ 'email' => $email , 'password' => \Hash::make( $password ) ] ) ,
            'token' => $User -> getToken( )  ,
        ] ) ) -> name( 'create'  ) ,
        Route::post( '/delete/{email}' , fn( string $email ) => response( ) -> json( [
            'user'  => $User = App\Models\User::where( [ 'email' => $email ] ) -> delete( )
        ] ) ) -> name( 'delete'  ) ,
    ] ) ,
    Route::name( 'auth.') -> group( fn ( ) => [
        Route::post( '/login'  , 'Authcontroller@login'  ) -> name( 'login'  ) ,
        Route::middleware( 'auth:sanctum' ) -> group( fn ( ) => [
            Route::get ( '/me'     , 'Authcontroller@me'     ) -> name( 'me'     ),
            Route::post( '/update' , 'Authcontroller@update' ) -> name( 'update' ),
        ] ) ,
    ] ),
    Route::middleware( 'auth:sanctum' ) -> group( fn ( ) => [
        Route::prefix( 'Chat' ) -> name( 'Chat.') -> group( fn ( ) => [
            Route::get ( '/Conversations/{Conversation}'      , 'ChatController@Conversation'  ) -> name( 'Conversation'  ) ,
            Route::get ( '/Conversations'                     , 'ChatController@Conversations' ) -> name( 'Conversations' ) ,
            Route::get ( '/Messages/{Conversation}'           , 'ChatController@Messages'      ) -> name( 'Messages'      ) ,
            Route::get ( '/Messages/{Conversation}/{Message}' , 'ChatController@Message'       ) -> name( 'Message'       ) ,
            Route::post( '/Send'                              , 'ChatController@Send'          ) -> name( 'Send'          ) ,
        ] ),
        Route::prefix( 'Users' ) -> name( 'Users.') -> group( fn ( ) => [
            Route::get( '/' , 'UsersController@All' ) -> name( 'All'  ) ,
        ] )
    ] ),
] ) ;