  <?php
  require_once 'bootstrap.php';
  
  $param['title']='Сотрудники';
    
  $Query=
    'SELECT 
      Employee.Id AS Id,
      Person.FullName AS "ФИО",
      Position.Title AS "Должности"
      
    FROM Person,Position,Employee
    WHERE 
		Employee.Id_Person = Person.Id AND 
		Employee.Id_Position = Position.Id
    ';
  
  $Query=getEmployeeModificatedForSearchingQuery($Query);
  Pagination($Query,$Navigation,5);  
  $p['title']='Сотрудники';
  $p['editHref']='edit_employee.php';
  $p['deleteHref']='delete_employee.php';
  $p['searchForm']=getEmployeeSearchForm();
  $p['Navigation']=$Navigation;
  $param['content']=getDBTableAsHTML($Query,$p);
       
  if (isAdmin())
  {
    $f['Action']='add_employee.php';
    $f['SubmitTitle']='Добавить';
    $param['content'].=getEmployeeForm($f);   
  }  
     
  template($param);


