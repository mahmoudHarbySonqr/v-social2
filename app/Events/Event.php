<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

Abstract class Event {

    use Dispatchable , InteractsWithSockets , SerializesModels ;

    public function broadcastAs( ) {
        return class_basename( static::class ) ;
    }

    Abstract public function broadcastWith ( );
    Abstract public function body         ( );

	public function broadcastType( ) : string {
        return static::class;
	}

	public function fireBaseCloudMessageingNotification( ) : array {
        return [
            'title'        => env ( 'APP_NAME' ) ,
            'body'         => $this -> body          ( ) ,
            'click_action' => $this -> broadcastType ( ) ,
            "sound"        => "default"
        ];
	}

	public function fireBaseCloudMessageingData( ) : array {
        return $this -> broadcastWith( ) + [
            'Type' => $this -> broadcastType( ) ,
		];
	}

}
