<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalAccessTokensTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up( ) {
        Schema::create( 'personal_access_tokens' , function ( Blueprint $table ) {
            $table -> id         ( 'id'               )                 ;
            $table -> morphs     ( 'tokenable'        )                 ;
            $table -> string     ( 'name'             )                 ;
            $table -> string     ( 'token', 64        ) -> unique ( )   ;
            $table -> text       ( 'abilities'        ) -> nullable ( ) ;
            $table -> timestamp  ( 'last_used_at'     ) -> nullable ( ) ;
            $table -> timestamps (                    )                 ;
            $table -> string     ( 'fireBaseId' , 191 ) -> nullable ( ) ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down( ) {
        Schema::dropIfExists( 'personal_access_tokens' );
    }
}