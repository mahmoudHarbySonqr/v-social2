<?php

namespace App\Http\Controllers\Api;

use Auth ;
use App\Models\User ;
use Illuminate\Http\Request ;
use Illuminate\Http\Response ;
use App\Http\Controllers\Controller;

use App\Http\Requests\Api\Chat\SendRequest ;
use App\Models\Conversation ;
use App\Http\Resources\Conversation as ConversationResources ;
use App\Http\Resources\messages     as messagesResources     ;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection ;

class ChatController extends Controller {
    public function Conversation( Request $Request , int $Conversation ) : ConversationResources {
        return new ConversationResources( Auth::user( ) -> Conversations( ) -> find( $Conversation ) );
    }
    public function Conversations( Request $Request ) : AnonymousResourceCollection {
        return ConversationResources::collection( Auth::user( ) -> conversations ( ) -> paginate( 15 ) ) ;
    }
    public function Message( Request $Request , int $Conversation , int $Message ) {
        return new messagesResources( Auth::user( ) -> Conversations( ) -> find( $Conversation ) -> messages( ) -> find( $Message ) );
    }
    public function Messages( Request $Request , int $Conversation ) : AnonymousResourceCollection {
        return messagesResources::collection( Auth::user( ) -> Conversations( ) -> find( $Conversation ) -> messages( ) -> paginate( 15 ) );
    }
    public function Send( SendRequest $Request ) {
        $Conversations = Auth::user( ) -> Conversations( ) -> where( 'Other.user_id' , ( int ) $Request -> get( 'user_id' ) ) ;
        if ( ! $Conversations -> exists( ) ) {
            $conversations = Auth::user( ) -> conversations ( ) -> create( [ 'user_id' => Auth::id( ) ] ) ;
            $conversations -> members ( ) -> sync( [ [ 'user_id' => Auth::id( ) ] , [ 'user_id' => $Request -> get( 'user_id' ) ] ] ) ;
        } else $conversations = $Conversations -> first( ) ;
        return new messagesResources( $conversations -> messages( ) -> create( [
            'user_id' => Auth ::id ( ) ,
            'contant' => $Request -> get( 'contant' , ''   ) ,
        ] ) -> edit( [ 'file' => $Request -> hasFile( 'file' ) ? $Request -> file( 'file' ) : null ] ) );
    }
}
