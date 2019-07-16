<?php
session_start();
include_once(__DIR__ . DIRECTORY_SEPARATOR . 'objectToArray.php');
include_once(__DIR__ . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
    $DBsql = new sql;

    $post = file_get_contents('php://input');
    $object = json_decode($post);
    $newVals = objectToArray($object);
    $consArr = array(
        'userID' => $_SESSION['user']['userID']
    );
    $res = $DBsql->updateDB('users', $newVals, $consArr);
    $_SESSION['user']['firstName'] = $newVals['firstName'];
    $_SESSION['user']['lastName'] = $newVals['lastName'];

    echo $res;