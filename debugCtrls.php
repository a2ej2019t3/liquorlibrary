<?php
    session_start();
    $_SESSION['location'] = 'somewhere';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <button type="button" id="s1" class="sorter">
        CLICK
    </button>

    <button type="button" class="sorter2">
        CLICK2
    </button>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        

    </script>
    <?php
    echo '
        <script>
            $(".sorter, .sorter2").attr("data-location", "'.$_SESSION['location'].'");
        </script>
        ';
    ?>
</body>

</html>