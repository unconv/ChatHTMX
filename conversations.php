<?php
foreach( array_reverse( glob( "chats/*.json" ) ) as $chat_file ) {
    $chat = json_decode(
        file_get_contents( $chat_file ),
        true,
    );
    echo '<button hx-get="/load_chat.php?chat_id='.htmlspecialchars( $chat['id'] ).'" class="chat-'.htmlspecialchars( $chat['id'] ).'" hx-target="main">'.htmlspecialchars( $chat["name"] ).'</button>';
}