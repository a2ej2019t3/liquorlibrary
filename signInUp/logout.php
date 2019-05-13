<?php
    session_start();
    unset($_SESSION['user']);

    if (isset($_SESSION['user'])) {
        echo 0;
    } else {
        echo 1;
    }
?>