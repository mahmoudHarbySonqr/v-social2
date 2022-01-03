<?php

namespace App\Events;

use Auth;
use App\Models\conversationMessages;
use App\Http\Resources\Conversation as ConversationResources ;
use App\Http\Resources\messages     as messagesResources     ;
use App\Http\Resources\User         as UserResources         ;

class NewMessage extends Event {

    public conversationMessages $Messages ;

    public function __construct( conversationMessages $Messages ) {
        $this -> Messages = $Messages ;
    }

    public function body( ) {
        return $this -> Messages -> user -> NameAll . ' : ' . $this -> Messages -> contant ;
    }

    public function broadcastWith( ) {
        return [
            'sender'       => new UserResources ( $this -> Messages -> user ) ,
            'others'       => UserResources::collection ( $this -> Messages -> Conversation -> members -> where( 'id' , '!=' , Auth::id( ) ) ) ,
            'Conversation' => new ConversationResources ( $this -> Messages -> Conversation ) ,
            'body'         => $this -> body( ) ,
        ]  ;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn( ) {
        return new PrivateChannel( 'channel-name' );
    }
}
