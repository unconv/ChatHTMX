<?php
if( ! file_exists( "chats" ) ) {
    mkdir( "chats" );
}

$chat_id = uniqid();

$chat = [
    "name" => "Untitled chat",
    "id" => $chat_id,
    "messages" => [],
];

file_put_contents(
    "chats/" . $chat_id . ".json",
    json_encode( $chat )
);

echo '<button hx-get="/load_chat.php?chat_id='.$chat_id.'&new=true" hx-target="main" hx-trigger="click, load" class="chat-'.$chat_id.'">' . htmlspecialchars( $chat["name"] ) . '</button>';