<?php
$datetime = new DateTime('NOW', new DateTimeZone('Asia/Jakarta'));
echo $datetime->format('Y-m-d H:i:s');

?>