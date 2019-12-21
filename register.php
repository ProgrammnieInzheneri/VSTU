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
			<h4 class="text-center">Регистрация</h4>
			<h6 class="text-center">
			<small class="text-muted">
			Поля со звездочкой обязательны
			</small>
			</h6>
            <input name="name" class="form-group form-control" type="text" placeholder="Имя*"/>
            <input name="login" class="form-group form-control" type="text" placeholder="Логин*"/>
            <input name="password" class="form-group form-control" type="password" placeholder="Пароль*"/>
            <input name="email" class="form-group form-control" type="email" placeholder="Почта*"/>
            <input name="phone" class="form-group form-control" type="tel" placeholder="Телефон"/>
            <input name="adress" class="form-group form-control" type="text" placeholder="Адрес"/>
            <input class="form-group form-control btn-info" type="submit" value="Зарегацца"/>
        </div>
		</div>
		</form>';
    $param['title'] = 'Регистрация | '.$config['site_title'];
    $param['content'] = $c;
    template($param);
}
if (checkRegistrationData())
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