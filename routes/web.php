<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get( '/' , fn ( ) => view( 'welcome' ) );

Route::name( 'Storage.' ) -> prefix( 'Storage' ) -> group( fn ( ) : array => [
    Route::get( 'conversationMessages/{Hash?}' , 'StorageController@conversationMessages' ) -> where ( 'path' , '.*' ) -> name( 'conversationMessages' ) ,
    Route::get( 'User/{Hash?}'                 , 'StorageController@User'                 ) -> where ( 'path' , '.*' ) -> name( 'User'                 ) ,
]) ;