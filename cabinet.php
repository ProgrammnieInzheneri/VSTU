
  <?php
  require_once 'bootstrap.php';
  
  $param['title']='Кабинеты';
    
  $Query=
    'SELECT 
      Cabinet.Id AS Id,
      Cabinet.Title AS "Кабинет",
	  Housing.Title AS "Корпус",
      Cabinet.Floor AS "Этаж"
    FROM Cabinet,Housing
    WHERE 
		Cabinet.Id_Housing = Housing.Id
    ';
  
  $Query=getCabinetModificatedForSearchingQuery($Query);
  Pagination($Query,$Navigation,5);  
  $p['title']='Кабинеты';
  $p['editHref']='edit_cabinet.php';
  $p['deleteHref']='delete_cabinet.php';
  $p['searchForm']=getCabinetSearchForm();
  $p['Navigation']=$Navigation;
  $param['content']=getDBTableAsHTML($Query,$p);
       
  if (isAdmin())
  {
    $f['Action']='add_cabinet.php';
    $f['SubmitTitle']='Добавить';
    $param['content'].=getCabinetForm($f);   
  }  
     
  template($param);
