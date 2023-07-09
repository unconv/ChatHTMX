<?php
$chat = json_decode(
    file_get_contents( "chats/" . basename( $_GET['chat_id'] ) . ".json" ),
    true,
);

echo '<div class="messages">';
foreach( $chat["messages"] as $message ) {
    echo '<div class="'.$message['role'].' message">'.nl2br( htmlspecialchars( $message["content"] ) ).'</div>';
}
echo '</div>';

?>
<form id="messageform" hx-post="/send_message.php" hx-target=".messages" hx-swap="beforeend">
    <input type="hidden" name="new" value="<?php echo htmlspecialchars( $_GET['new'] ?? "false" ); ?>" />
    <input type="hidden" name="chat_id" value="<?php echo htmlspecialchars( $_GET['chat_id'] ); ?>" />
    <input type="text" name="message" />
    <button>Send</button>
</form>