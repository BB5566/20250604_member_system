<?php
// debug_post.php
if (file_exists('debug_post.txt')) {
    echo nl2br(htmlspecialchars(file_get_contents('debug_post.txt')));
} else {
    echo '沒有 debug_post.txt';
}
?>
