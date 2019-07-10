<?php
include_once(__DIR__ . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'DBsql.php');
$DBsql = new sql;

$res = $DBsql->select('users', array('spec'=>'resettime IS NOT NULL'));
var_dump($res);
if ($res != null) {
    foreach ($res as $key => $value) {
        $minutes = ((time() - strtotime($value['resettime']))) / 60;
        if ($minutes > 5) {
            $res = $DBsql->updateDB('users', array('resettoken'=> NULL, 'resettime'=> NULL), array('userID'=>$value['userID']));
            var_dump($res);
            if ($res) {
                echo 'user ID: '.$value['userID'].', Reset password request expired';
            } else {
                echo 'faild to delete token';
            }
        } else {
            echo 'user ID: '.$value['userID'].', Reset password request expire in: '.round((5-$minutes), 1). ' minutes.';
        }
    }
} else {
    echo 'no request. peaceful day.';
}