<?php
include_once 'db.php';
header("Access-Control-Allow-Origin:*");
header("Access-Control-Methods:GET,POST,OPTION");
header("Access-Control-Allow-Headers:*");

$res  = file_get_contents("php://input");
$dat = json_decode($res);
var_dump($dat, $res);

if ($dat->for === 'insert') {

    $db = new Db();
    $d = [
        'name' => $dat->name,
    ];
    if ($db->insert('user', $d)) {
        echo 'alham';
        // echo $dat->name;
    } else {
        echo 'sabr';
    }
}
