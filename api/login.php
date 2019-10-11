<?php

require_once '../bootstrap.php';

global $link;
$result = array();
if (isset($_GET['login'],$_GET['password']))
{
    $q='SELECT * FROM admin WHERE '.
        '(login=\''.addslashes($_GET['login']).'\') AND '.
        '(password=\''.getHash($_GET['password']).'\')';

    $r=mysqli_query($link,$q);
    if ($r){
        if (mysqli_num_rows($r)>0){
            $row=mysqli_fetch_array($r);
            $id = $row['id'];
            $result = array("status" => true, "data" => $id);
        }
        else {
            $result = array("status" => false, "error" => 401);
        }
    };
};

echo json_encode($result, JSON_UNESCAPED_UNICODE);