<?php
require_once 'bootstrap.php';

if (isAdmin())
{
    header('location:'.$config['site_url']);
}
else
{
    $c =
        '<form class="container" method="POST">
			<div class="row justify-content-center">
			<div class="col-3">
			<h4 class="text-center">Вход</h4>
            <input name="login" class="form-group form-control" type="text" placeholder="Логин"/>
            <input name="password" class="form-group form-control" type="password" placeholder="Пароль"/>
            <input class="form-group form-control btn-info" type="submit" value="Зайдитэ"/>
        </div>
		</div>
		</form>';
    $param['title'] = 'Login | '.$config['site_title'];
    $param['content'] = $c;
    template($param);
}
if (isset($_POST['login'],$_POST['password']))
{
    $q='SELECT * FROM users WHERE '.
        '(login=\''.addslashes($_POST['login']).'\') AND '.
        '(password=\''.getHash($_POST['password']).'\')';
    $r=mysqli_query($link,$q);
    if ($r){
        if (mysqli_num_rows($r)>0){
            $row=mysqli_fetch_array($r);
            $_SESSION['Id']=$row['id'];
            header('location:'.$config['site_url']);
        }
    };
}