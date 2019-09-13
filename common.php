<?php
/**
* Функция для установки обработчика ошибок
*/
function initErrorHandler()
{
  // Добавлять сообщения обо всех ошибках, кроме E_NOTICE
  error_reporting(E_ALL ^ E_NOTICE); 
  /* Эта настройка определяет, требуется ли выводить ошибки на экран вместе с остальным выводом, либо ошибки должны быть скрыты от пользователя. */
  ini_set('display_errors','On');	
  // регистрация функции, выполняемой после работы скрипта
  //	 она будет выполняться даже в случае фатальной ошибки
  register_shutdown_function('errorsHandler');
  // начало буферизации вывода
  ob_start();
}


/**
* Обработчик ошиьок
*/
function errorsHandler()
{
  global $config;
  // получение информации о последней ошибке
  $error = error_get_last();
  // если есть ошибка
  if (isset($error))
  {
    // установка http-статуса ответа сервера
    header('HTTP/1.1 500 Internal Server Error');
    header("Status: 500 Internal Server Error");
    // если приложение в режиме разработки
    if ($config['app_mode'] == 'development')
    {
      // завершение буферизации вывода и очищение буфера
      ob_end_clean();
      // вывод информации об ошибке
      echo '<pre>';
      var_dump($error);
      echo '</pre>';
    } 
    // если приложение НЕ в режиме разработки
    else
    {
      // завершение буферизации вывода и очищение буфера
      ob_end_clean(); // сбросить буфер
      // вывод сообщение об ошибке для пользователя
      // в дальнейшем следует оформить в виде полноценной страницы
      echo '500 Ошибка сервера';
      // отправка письма администратору с сообщением об ошибке
      mail(
        $config['admin_email'], 
        $config['site_url'].' 500 Error', 
        var_export($error, TRUE));
    }
  } 
  // нет ошибки
  else
  {
    // завершение буферизации вывода и вывод буфера
    ob_end_flush(); // вывод буфера
  }
}
// глобальная переменная для хранения настроек приложения
$config=array();
/**
* Функция для загрузки настроек приложения
*/
function initConfig()
{
  // использовать глобальную переменную $config
  global $config;
  // загрузка настроек из файла config.php
  $config = require 'config.php';
}

// глобальная переменная для хранения подключения к БД
$link; 
/**
* Функция для подключения к БД
*/
function connectToDB()
{
  // использовать глобальную переменную $link
  global $link;
  // использовать глобальную переменную $config
  global $config;
  // подключиться к БД, используя настройки, 
  //   загруженные из файла config.php
  $link=mysqli_connect('localhost',
    $config['db']['login'],
    $config['db']['password'],
    $config['db']['name']);
  // установления кодировки текста для подключения к БД
  mysqli_query($link,'SET NAMES utf8');
  return $link;
}
/**
* Функция, возвращающая элемент массива с заданным индексом, 
* если он существует, или пустую строку – если нет
*
* @param  array  $array  Array
* @param  mixed  $key    Key to found
* @return string
*/
function _a($array,$key)
{
  $result='';
  if ($array AND is_array($array) AND isset($array[$key]))
      $result=$array[$key];
  return $result;
}

/**
* Функция, печатающая переданную переменную в html-теге <pre> 
* с учетом ее типа
*
* @param  mixed    $var         Variable to print
* @param  boolean  $only_value  Print value only (TRUE, default) or full variable information else
* @return void
*/
function pre($var,$only_value=true)
{
  echo '<pre>';
  if ($only_value)
    echo $var;
  else
    if (is_array($var))
      print_r($var);
    else
      var_dump($var);
  echo '</pre>';
}
/**
* Функция для вывода шаблона страницы с учетом параметров
*
* @param  array  $ params  Page options (title, content etc.)
* @return void
*/
function template($params=array())
{
  echo 
'<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<title>'._a($params,'title').'</title>
	<meta name="keywords" content="'._a($params,'keywords').'" />
	<meta name="description" content="'._a($params,'description').'" />
	<link href="css/style.css" rel="stylesheet">  
  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>

<div class="wrapper">

	<header class="header row">
	'.getHeader().'
	</header><!-- .header-->

  <main class="content">
    '._a($params,'content').'
  </main><!-- .content -->

</div><!-- .wrapper -->

  <footer class="footer">
    <p class="text-center">&copy;&nbsp;2016&nbsp;Noname</p>
  </footer><!-- .footer -->
  <!-- jQuery (necessary for Bootstrap\'s JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>';
}
/**
* Функция для для генерации html кода таблицы
* с данными, выбранными из БД sql-запросом
*
* @param  string $query  SQL query
* @param  array  $params HTML table options (title, css styles..)
* @return string
*/

function getDBTableAsHTML($query,$params=array())
{
  global $link;  
  $title='';
  $tableTitleClass='lead text-center';
  $tableClass='table table-striped t';
  $editHref='';
  $deleteHref='';
  $showSearchForm=TRUE;
  $searchForm='';
  $Navigation='';
  extract($params);
  
  
  $result=mysqli_query($link,$query);
  
  $c='';
  if ($title=='query')
    $c='<p class="'.$tableTitleClass.'">'.$query.'</p>';
  elseif ($title!='')
    $c='<p class="'.$tableTitleClass.'">'.$title.'</p>';  
   
   
  if (mysqli_num_rows($result)==0)
  {
    if (isset($_GET['Search']))
    {
      $c.='<table class="'.$tableClass.'"><thead><tr>'.
        $searchForm.
        '</tr></thead></table>'; 
    }
    $c.='<p class="text-center alert-warning">Нет данных</p>';
  }
  else
  {
    $c.=$Navigation.'<table class="'.$tableClass.'"><thead><tr>';
    
    $fields=mysqli_fetch_fields($result);
    
    if ($showSearchForm)
    {
      $c.=$searchForm;    
    }
    
    // отображение имен полей, возможно алиасы
    foreach ($fields as $field) 
    {  
      if ($field->name=='Id')
        if (!isAdmin())
          continue;
      $c.='<th>'.$field->name.'</th>';
    }
    if (isAdmin())
      $c.='<th colspan="2">Операции</th>';
    $c.='</tr></thead><tbody>';  
     
    // отображение содержимого запроса (строк таблицы)
    while ($row = mysqli_fetch_assoc($result)) 
    {
      $c.='<tr>';
      foreach ($row as $key => $value) 
      {
        if ($key=='Id')
          if (!isAdmin())
            continue;
        $c.='<td>'.$value.'</td>';      
      }  
      if (isAdmin())
        $c.='<td><a class="btn btn-success" href="'.$editHref.'?Id='.$row['Id'].'">Редактировать</a></td>'.
          '<td><a class="btn btn-danger" href="'.$deleteHref.'?Id='.$row['Id'].'">Удалить</a></td>';
      $c.='</tr>';
    }
    
    $c.='</tbody></table>'.$Navigation;
  }
  return $c;
}


/**
* Функция для получения хеша с «солью»
*/

function getHash($data)
{
  $salt='default_salt_@#$%@#$%^U';
  if (isset($config['salt']))
    $salt=$config['salt'];
  return hash('sha256',$data.$salt);
}
/**
* Функция для проверки того, что оператор БД прошел аутентификацию
*/
function isAdmin()
{
  if (session_status()!==PHP_SESSION_ACTIVE)
    return FALSE;
  else
    if (isset($_SESSION['Id']))
      return TRUE;
    else
      return FALSE;
}

/**
* Функция для проверки того, что оператор БД прошел аутентификацию,
* и переадресации на главную страницу – если нет
*/
function checkAdminAndRedirectIfNot()
{
  global $config;
  if (isAdmin())
    return TRUE;
  else
    header('location:'.$config['site_url']);
}

function getHeader()
{
  global $config;
  if (isAdmin())
  {
    return 

'    <div class="row">
      <h1 class="col-md-9 text-center">Crownfanding))0</h1>
      <div class="col-md-3 btn-group" role="group">
        <a class="btn btn-primary" href="profile.php">Профиль</a>
        <a class="btn btn-warning" href="logout.php">Выйти</a>   
      </div>
    </div>  
    <div class="text-center"> 
      <div class="btn-group " role="group">
        <a class="btn btn-primary" href="index.php">Проекты</a>
        <a class="btn btn-primary" href="position.php">Должности</a>
        <a class="btn btn-primary" href="person.php">Кадры</a>
        <a class="btn btn-primary" href="employee.php">Сотрудники</a>
        <a class="btn btn-primary" href="housing.php">Корпуса</a>
        <a class="btn btn-primary" href="cabinet.php">Кабинеты</a>
        <a class="btn btn-primary" href="department.php">Подразделения</a>
      </div>
    </div>';
  }
  else
  {
    return
'		<h1 class="col-md-9 text-center">Телефонный справочник</h1>
    <form class="col-md-3" method="post" action="login.php">
      <input name="login" class="form-group form-control" type="text" placeholder="Логин"/>
      <input name="password" class="form-group form-control" type="password" placeholder="Пароль"/>
      <input class="form-group form-control btn-primary" type="submit" value="Войти"/>
    </form>';
	
	
	
  }
}
/**
* Функция для сохранения истории переходов в сессии
*/
function updateHistory()
{
  $url=$_SERVER['REQUEST_URI'];
  if (isset($_SESSION['history']))
  {
    $history=$_SESSION['history'];
  }
  $history[]=$url;
  $n=count($history);
  
  $history=array_slice($history,-10);
  
  $_SESSION['history']=$history;
}

/**
* Функция для получения массива с историей переходов
*/
function getHistory()
{
  $history=array();
  if (isset($_SESSION['history']))
  {
    $history=$_SESSION['history'];
  }
return $history;
}

/**
* Функция для переадресации на заданное количество шагов назад
*
* @param int $step Количество шагов 
*/
function goBack($step=1)
{
  $history=getHistory();
  $n=count($history);
  if ($n>0)  
    header('location:'.$history[max(0,$n-$step-1)]);
}

function getHtmlSelectForDbTableField($param=array())
{
  if (is_array($param))
  {
    global $link;
    $SelectName='Id_Parent';
    $SelectedId=0;
    $Query='SELECT * FROM Department ORDER BY Path';
    $IdField='Id';
    $ValueField='Title';
    extract($param);
    
    $Result=mysqli_query($link,$Query);
    if (!$Result) 
      return '<select class="form-control" name="'.$SelectName.
        '" id="'.$SelectName.'"></select>';
    $n=mysqli_num_rows($Result);
    $Select='<select class="form-control" name="'.$SelectName.
      '"  id="'.$SelectName.'">';
    while ($Row=mysqli_fetch_array($Result))
    {
      $Selected='';
      if ($Row[$IdField]==$SelectedId)
        $Selected=' selected="selected" ';
      $Select.='<option '.$Selected.' value="'.$Row[$IdField].'">'.
        $Row[$ValueField].'</option>';
    }
    $Select.='</select>';
  }
  else
    $Select='<select class="form-control"></select>';
  return $Select;
}

function getDepartmentsAsHtmlSelect($param=array())
{
  if (is_array($param))
  {
    global $link;
    $SelectName='Id_Parent';
    $SelectedId=0;
    $Query='SELECT * FROM phonebook.department ORDER BY Path';
    $IdField='Id';
    $ValueField='Title';
    extract($param);
    
    $Result=mysqli_query($link,$Query);
    if (!$Result)
      return '<select class="form-control" 
        name="'.$SelectName.'" id="'.$SelectName.'">
        <option value="0">---</option></select>';
    $n=mysqli_num_rows($Result);
    $Select='<select class="form-control" 
      name="'.$SelectName.'"  id="'.$SelectName.'">
      <option value="0">---</option>';
 
   while ($Row=mysqli_fetch_array($Result))
    {
      $Selected='';
      if ($Row[$IdField]==$SelectedId)
        $Selected=' selected="selected" ';
      $Level=substr_count($Row['Path'],'/');
      $Offset=str_repeat('&nbsp;',max(0,$Level*2-2));
      $Select.='<option '.$Selected.' value="'.$Row[$IdField].'">'.
        $Offset.$Row[$ValueField].'</option>';
    }
    $Select.='</select>';
  }
  else
    $Select='<select class="form-control">
      <option value="0">---</option></select>';
  return $Select;
}
function Pagination(&$Query, &$NavigationBlock, $RowsPerPage=10,
  $ButtonsCount=5)
{
	global $link;
	$a=explode('FROM',$Query);
	// запрос для подсчета количества выбираемых записей
	$q='SELECT COUNT(*) FROM '.$a[1];
	$result=mysqli_query($link,$q);
	$Row=mysqli_fetch_array($result);
	// $n – общее количества записей
	$n=$Row[0];
	$Page=0;
// получение номера текущей страницы из массива $_GET
	if (isset($_GET['Page']))
		$Page=(int)$_GET['Page'];
	// модификация запроса для выбора части записей, 
//  которые должны быть отображены на текущей странице

	
	$Query.=' LIMIT '.$Page*$RowsPerPage.','.$RowsPerPage;
	// $PagesCount – количество страниц
	$PagesCount=ceil($n/$RowsPerPage);
	$NavigationBlock='';
    // если больше 1 страницы, то отобразить 
//  блок постраничной навигации
	if ($PagesCount>1)
    {
		$NavigationBlock=
         '<nav class="center-block text-center">
		 <ul class="pagination">'; 
		 
		 $NavigationBlock.='<a href = "' .$_SERVER['SCRIPT_NAME'].'?'.f(0).'">|&lt;</a>';			
		 $NavigationBlock.='<a  href = "' .$_SERVER['SCRIPT_NAME'].'?'.f(max(0,$Page-1)).'">&lt;</a>';					
		
		$StartPage = max(0,$Page -2);
		$LastPage =  min($PagesCount-1,$StartPage +4);
		$StartPage = max(0,$Page -4);
		for ($i = $StartPage; $i <=$LastPage;$i++)
		{
			$style ='';
			if ($i ==$Page)
				$style = ' style = "border:1px solid blue;" ';
		$NavigationBlock.='<a '.$style.' href = " ' .$_SERVER['SCRIPT_NAME'].
							'?'.f($i).'">'.($i+1).'</a>';
		}
		$NavigationBlock.='<a href = " ' .$_SERVER['SCRIPT_NAME'].'?'.f(min($PagesCount-1,$Page +1)).'">&gt;</a>';			
		$NavigationBlock.='<a href = " ' .$_SERVER['SCRIPT_NAME'].'?'.f($PagesCount-1).'">&gt;|</a>';					
		$NavigationBlock.='</ul></nav>';
		
		
	}
}
function f($i)
{
	$_GET['Page'] = $i;
	$a  = Array();
	foreach ($_GET as $key => $value)
	$a[] =$key.'='.$value;
	return implode ('&',$a);
}
