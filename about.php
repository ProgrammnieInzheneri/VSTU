<?php
require_once 'bootstrap.php';

$param['title']=$config['site_title'];
//Html код основной части страницы
$c = '* немножечка о нас *';
$param['content'] = $c;
template($param);