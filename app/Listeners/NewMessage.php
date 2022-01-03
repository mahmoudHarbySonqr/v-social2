<?php

namespace App\Listeners;

use Auth;
use App\Services\FireBaseCloudMessageingGun;

class NewMessage {
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle( $event ) {
        return FireBaseCloudMessageingGun::fire(
            $event -> Messages -> Conversation -> members -> where( 'id' , '!=' , Auth::id( ) ) -> pluck( 'TokensFireBaseId' ) -> toArray( ) ,
            $event -> fireBaseCloudMessageingNotification( ) ,
            $event -> fireBaseCloudMessageingData( )
        );
    }
}
