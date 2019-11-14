<?php
require_once 'bootstrap.php';

if (isset($_GET['id']))
{
    $id = $_GET['id'];
}
else
{
    $id = -1;
}

$content = getProjectHtml($id);

$param['title']=$config['site_title'];
$param['content'] = $content;
template($param);

