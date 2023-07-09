<?php
$chat = json_decode(
    file_get_contents( "chats/" . basename( $_POST['chat_id'] ) . ".json" ),
    true,
);

$chat["messages"][] = [
    "role" => "user",
    "content" => $_POST['message']
];

file_put_contents(
    "chats/" . basename( $_POST['chat_id'] ) . ".json",
    json_encode( $chat )
);

echo '<div class="user message" hx-trigger="load" hx-get="/get_response.php?chat_id='.htmlspecialchars( $_POST['chat_id'] ).'&new='.htmlspecialchars( $_POST['new'] ?? "false" ).'" hx-target=".messages" hx-swap="beforeend">'.nl2br( htmlspecialchars( $_POST['message'] ) ).'</div>';

echo '<script>messageform.reset()</script>';