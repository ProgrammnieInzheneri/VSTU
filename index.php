<?php
  require_once 'bootstrap.php';
  
  $param['title']='Crownfanding))0';
    
  $Query=
    'SELECT 
      project.id_project AS Id,
      project.title AS "Имя",
      project.date AS "Дата создания",
      project.description AS "Описание проекта",
      project.period AS "Длительность кампании",
      project.requestFunds "Требуемая сумма",
      user.name AS "Организатор кампании"
    FROM project, user
    WHERE
      project.id_user = user.id_user';
  
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
    //  
  }  
     
  template($param);
