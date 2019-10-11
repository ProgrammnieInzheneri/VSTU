<?php

require_once 'common.php';
require_once 'check.php';
require_once 'form.php';
require_once 'db.php';

session_start();  // старт сессии
updateHistory();
initErrorHandler();
initConfig();     // загрузка конфигурации
connectToDB();    // подключение к БД