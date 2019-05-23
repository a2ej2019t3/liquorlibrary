<?php
    session_start();
    session_unset();

    if (isset($_SESSION['user'])) {
        echo 0;
    } else {
        echo 1;
    }
?>