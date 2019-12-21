<?php
require_once 'bootstrap.php';

if (isset($_GET['projectId']))
{
    $projectId = $_GET['projectId'];

    $content =
        '<form method = "POST" action = "create_transaction.php">
            <input type = "hidden" name = "projectId" value = '.$projectId.' ></input>
            <input type = "text" name = "sum" ></input>
            <select name = "paymentMethod" size = "1">
                <option selected value = "fake">Демонстрационный</option>
                <option value = "fake2">Демонстрационный2</option>
            </select><br>
            <input type = "submit" value = "Отправить"></input>
        </form>';

    $param['title'] = "Задонатить".$config['site_title'];
    $param['content'] = $content;
    template($param);
}
