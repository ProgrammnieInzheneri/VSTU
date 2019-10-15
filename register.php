<?php
require_once 'bootstrap.php';

if (isAdmin())
{
    header('location:'.$config['site_url']);
}
else
{
    $c =
        '<form class="col-md-3" method="POST">
            <input name="name" class="form-group form-control" type="text" placeholder="Имя*"/>
            <input name="login" class="form-group form-control" type="text" placeholder="Логин*"/>
            <input name="password" class="form-group form-control" type="password" placeholder="Пароль*"/>
            <input name="email" class="form-group form-control" type="email" placeholder="Почта*"/>
            <input name="phone" class="form-group form-control" type="tel" placeholder="Телефон"/>
            <input name="adress" class="form-group form-control" type="text" placeholder="Адрес"/>
            <input class="form-group form-control btn-primary" type="submit" value="Зарегацца"/>
        </form>';
    $param['title'] = 'Регистрация | '.$config['site_title'];
    $param['content'] = $c;
    template($param);
}
if (isset(
    $_POST['name'],
    $_POST['login'],
    $_POST['password'],
    $_POST['email']))
{
    $q='
        INSERT INTO users (name, login, password, email, phone, adress) VALUES ("'
            .$_POST['name'].'", "'
            .$_POST['login'].'", "'
            .getHash($_POST['password']).'", "'
            .$_POST['email'].'", "'
            .$_POST['phone'].'", "'
            .$_POST['adress'].'")';
    $r=mysqli_query($link,$q);
    header('location:'.$config['site_url'].'login.php');
}