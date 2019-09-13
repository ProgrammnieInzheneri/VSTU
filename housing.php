
 <?php
  require_once 'bootstrap.php';
  
  $param['title']='Корпуса';
    
  $Query=
    'SELECT 
      Housing.Id AS Id,
	  Address AS "Адрес",
	  Title AS "Корпус",
	  Abbreviation AS "Сокращение"
    FROM Housing
    
    ';
  
  $Query=getHousingModificatedForSearchingQuery($Query);
  Pagination($Query,$Navigation,5);  
  $p['title']='Корпуса';
  $p['editHref']='edit_housing.php';
  $p['deleteHref']='delete_housing.php';
  $p['searchForm']=getHousingSearchForm();
  $p['Navigation']=$Navigation;
  $param['content']=getDBTableAsHTML($Query,$p);
       
  if (isAdmin())
  {
    $f['Action']='add_housing.php';
    $f['SubmitTitle']='Добавить';
    $param['content'].=getHousingForm($f);   
  }  
     
  template($param);


