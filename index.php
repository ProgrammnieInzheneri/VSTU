<?php
  require_once 'bootstrap.php';
  
  $param['title']='Crownfanding))0';
    
  $Query=
    'SELECT 
      Subscriber.Id AS Id,
      CONCAT(Position.Title," ",Person.FullName) AS "Сотрудник",
      CONCAT(Housing.Abbreviation," ",Cabinet.Title) AS "Кабинет",
      Department.Title AS "Подразделение",
      Phone AS "Телефон",
      InterofficePhone AS "Вн.тел.",
      Email AS "e-mail"
    FROM Person,Position,Employee,Housing,Cabinet,Department,Subscriber 
    WHERE 
      Employee.Id_Position=Position.Id AND 
      Employee.Id_Person=Person.Id AND 
      Subscriber.Id_Employee=Employee.Id AND
      Cabinet.Id_Housing=Housing.Id AND 
      Subscriber.Id_Cabinet=Cabinet.Id AND
      Subscriber.Id_Department=Department.Id';
  
  $Query=getModificatedForSearchingQuery($Query);
    Pagination($Query,$Navigation,5);
  $p['title']='Абоненты';
  $p['editHref']='edit_subscriber.php';
  $p['deleteHref']='delete_subscriber.php';
  $p['searchForm']=getSubscriberSearchForm();
   $p['Navigation']=$Navigation;
  $param['content']=getDBTableAsHTML($Query,$p);
       
  if (isAdmin())
  {
    $f['Action']='add_subscriber.php';
    $f['SubmitTitle']='Добавить';
    $param['content'].=getSubscriberForm($f);   
  }  
     
  template($param);
