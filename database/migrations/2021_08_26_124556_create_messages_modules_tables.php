<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
/**
    table conversation{
        user_id int
        id      int
    }
    table conversation_members{
        id      int
        user_id int
        conversation_id int
    }
    table messages{
        id      int
        user_id int
        conversation_id int
        contant int
        type    enum
        hash    str
    }
*/
class CreateMessagesModulesTables extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up( ) {
        Schema::create( 'conversations'         , function ( Blueprint $table ) {
            $table -> id        (                  ) ;
            $table -> foreignId ( 'user_id'        ) -> references( 'id' ) -> on( 'users' ) -> onDelete( 'cascade' ) -> onUpdate( 'cascade' ) ;
            $table -> timestamps(                  ) ;
        });
        Schema::create( 'conversation_members'  , function ( Blueprint $table ) {
            $table -> foreignId( 'user_id'         ) -> references( 'id' ) -> on( 'users'         ) -> onDelete( 'cascade' ) -> onUpdate( 'cascade' ) ;
            $table -> foreignId( 'conversation_id' ) -> references( 'id' ) -> on( 'conversations' ) -> onDelete( 'cascade' ) -> onUpdate( 'cascade' ) ;
        });
        Schema::create( 'conversation_messages' , function ( Blueprint $table ) {
            $table -> id        (                   ) ;
            $table -> foreignId ( 'user_id'         ) -> references( 'id' ) -> on( 'users'         ) -> onDelete( 'cascade' ) -> onUpdate( 'cascade' ) ;
            $table -> foreignId ( 'conversation_id' ) -> references( 'id' ) -> on( 'conversations' ) -> onDelete( 'cascade' ) -> onUpdate( 'cascade' ) ;
            $table -> string    ( 'contant'         ) ;
            $table -> string    ( 'hash'            ) -> nullable( ) ;
            $table -> timestamps(                   ) ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down( ) {
        Schema::dropIfExists( 'conversation_messages' ) ;
        Schema::dropIfExists( 'conversation_members'  ) ;
        Schema::dropIfExists( 'conversations'         ) ;
    }
}
