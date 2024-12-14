<?php
function generateUniqueId() {
    return bin2hex(random_bytes(16));
}
?>
