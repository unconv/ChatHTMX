<?php
require("ChatGPT.php");

$chat = json_decode(
    file_get_contents( "chats/" . basename( $_GET['chat_id'] ) . ".json" ),
    true,
);

$assistant_message = end( $chat["messages"] );
$user_message = prev( $chat["messages"] );

$chatgpt = new ChatGPT( getenv("OPENAI_API_KEY") );
$chatgpt->smessage(
    "You are a conversation title generator. Respond only with a simple title."
);
$chatgpt->umessage( "Please create a title for this conversation:\nQ: " . $user_message['content'] . "\nA: " . $assistant_message['content'] );

$response = (array)$chatgpt->response();

$title = trim( $response["content"], '"' );

$chat["name"] = $title;

file_put_contents(
    "chats/" . basename( $_GET['chat_id'] ) . ".json",
    json_encode( $chat )
);

echo $title;