<?php
  require_once 'bootstrap.php';
  
  // Проверить, что пользователь авторизован, 
  //  и перейти на главную страницу, если нет
  if (checkAdminAndRedirectIfNot())
  {
    // Если в массиве $_GET есть Id
    if (checkId($_GET))
    {
      // Если в массиве $_GET есть данные о подразделении 
      if (issetDepartmentData($_GET))
      {
        //  Id текущего подразделения
        $Id=$_GET['Id'];
        //  Найти в БД подразделение с заданным Id
        $Result=mysqli_query($link,
          'SELECT * FROM Department WHERE Id='.$Id); 
        // Если есть подразделение с заданным Id
        if ($Row=mysqli_fetch_assoc($Result))
        {
          // Путь (Path) текущего подразделения
          $Path=$Row['Path'];
          // Найти родительское подразделение
          $Result=mysqli_query($link,
            'SELECT * FROM Department 
             WHERE Id='.$_GET['Id_Parent']);  
          // Если есть родительское подразделение 
          // с заданным Id_Parent 
          if ($Row=mysqli_fetch_assoc($Result))
          {
            // Новый путь текущего подразделения = 
            //    Путь родителя + Id + /
            $NewPath=$Row['Path'].$Id.'/';
            // Если путь текущего подразделения не изменился
            if ($Path===$NewPath) 
            {
              // Обновить в БД только название
              //   текущего подразделения
              mysqli_query($link,
               'UPDATE Department 
                SET Title="'.$_GET['Title'].'" 
                WHERE Id='.$Id);                
            }
            // Иначе - путь текущего подразделения изменился
            else
            {
              // Обновить в БД путь и название 
              //  текущего подразделения
              mysqli_query($link,'UPDATE Department '.
                'SET path="'.$NewPath.'", '.
                'Title="'.$_GET['Title'].'" '.
                'WHERE Id='.$Id);   
              // Обновить в БД пути для подподразделенеий 
              //  текущего подразделения
              mysqli_query($link,
                'UPDATE Department '.
                'SET path=CONCAT(
                    "'.$NewPath.'",
                    SUBSTRING(Path,'.(strlen($Path)+1).')) '.
                'WHERE path LIKE "'.$Path.'%"');                   
            }
          }
          // Иначе - нет родительского подразделения 
          //  с заданным Id_Parent 
          else
          {
            // Обновить в БД путь и название текущего подразделения
            // Путь = Id + /
            mysqli_query($link,
              'UPDATE phonebook.department SET 
                Title="'.$_GET['Title'].'",
                Path="'.$Id.'/"
               WHERE Id='.$Id);
          }
        }
        // Вернуться на страницу Подразделения
        goBack(2); 
      }
      // Иначе - данных нет, только Id
      else
      {
        // Задать заголовок страницы
        $param['title']='Подразделения - редактирование';
        // Если удалось получить из БД данные о подразделении по Id
        if ($f=getDepartment($_GET['Id']))
        {
          $f['Method']='get';
          $f['SubmitTitle']='Сохранить';
          $f['ShowCancel']=TRUE;
          $f['FormTitle']='Подразделения - редактирование';
          // Задать контентом страницы форму для редактирования 
          //  подразделения с загруженными данными
          $param['content']=getDepartmentForm($f);
        }
        // Иначе - в БД нет данных о подразделении
        else
        {
          // Задать контентом страницы сообщение 
          //   "Нет записи с Id = ..."
          $param['content']='Нет записи с Id='.$_GET['Id'];          
        }
        // Вывести шаблон страницы с заданными параметрами
        template($param);
      }
    }
    // Иначе - в массиве $_GET нет Id
    else
    {
      // Вернуться на страницу Подразделения
      goBack();    
    }
  }
