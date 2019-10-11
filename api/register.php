<?php

require_once '../bootstrap.php';
global $link;

$result=mysqli_query($link,'SELECT COUNT(*) FROM admin');
$row=mysqli_fetch_row($result);

if (isset($_GET['login'], $_GET['password'], $_GET['name']))
{
    if ($row[0] !== 0)
    {
        $q = 'INSERT INTO admin (login, password, name) VALUES ("' .
            $_GET['login'] . '", "' . getHash($_GET['password']) . '", "' . $_GET['name'] . '")';
        mysqli_query($link, $q);
        $result = array("status" => true);
    } else
    {
        $result = array("status" => false);
    }
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);