<?php
require("ChatGPT.php");

$chat = json_decode(
    file_get_contents( "chats/" . basename( $_GET['chat_id'] ) . ".json" ),
    true,
);

$message = end( $chat["messages"] );

$chatgpt = new ChatGPT( getenv("OPENAI_API_KEY"), $_GET['chat_id'] );
$chatgpt->loadfunction( function( $chat_id ) use ( $chat ) {
    return $chat["messages"];
} );
$chatgpt->load();
$chatgpt->umessage( $message["content"] );

$response = (array)$chatgpt->response();

$chat["messages"][] = $response;

file_put_contents(
    "chats/" . basename( $_GET['chat_id'] ) . ".json",
    json_encode( $chat )
);

if( empty( $chat["name"] ) || $chat["name"] == "Untitled chat" ) {
    $create_title = 'hx-trigger="load" hx-get="/create_title.php?chat_id='.htmlspecialchars( $_GET['chat_id'] ).'" hx-target=".chat-'.htmlspecialchars( $_GET['chat_id'] ).'"';
} else {
    $create_title = '';
}

echo '<div class="assistant message" '.$create_title.'>'.nl2br( htmlspecialchars( $response["content"] ) )."name:".$chat['name'].'</div>';
