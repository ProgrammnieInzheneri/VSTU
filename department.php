
  <?php
  require_once 'bootstrap.php';
  
  $param['title']='Подразделения';
    
  $Query=
    'SELECT 
      Department.Id AS Id,
      Department.Title AS "Подразделение",
	  Department.Path AS "Родительское подразделение"
      
    FROM Department
    ';
  $Query=getDepartmentModificatedForSearchingQuery($Query);
  Pagination($Query,$Navigation,5);  
  $p['title']='Подразделения';
  $p['editHref']='edit_department.php';
  $p['deleteHref']='delete_department.php';
  $p['searchForm']=getDepartmentSearchForm();
  $p['Navigation']=$Navigation;
  $param['content']=getDBTableAsHTML($Query,$p);
       
  if (isAdmin())
  {
    $f['Action']='add_department.php';
    $f['SubmitTitle']='Добавить';
    $param['content'].=getDepartmentForm($f);   
  }  
     
  template($param);
