<?php
$length = 75;
$token = bin2hex(random_bytes($length));

echo $token;