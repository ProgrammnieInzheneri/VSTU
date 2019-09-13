 <?php
  require_once 'bootstrap.php';
  
  $param['title']='Должности';
    
  $Query=
    'SELECT 
      Position.Id AS Id,
      Title AS "Должности"
    FROM Position
    ';
  
  $Query=getPositionModificatedForSearchingQuery($Query);
  Pagination($Query,$Navigation,5);  
  $p['title']='Должности';
  $p['editHref']='edit_position.php';
  $p['deleteHref']='delete_position.php';
  $p['searchForm']=getPositionSearchForm();
  $p['Navigation']=$Navigation;
  $param['content']=getDBTableAsHTML($Query,$p);
       
  if (isAdmin())
  {
    $f['Action']='add_position.php';
    $f['SubmitTitle']='Добавить';
    $param['content'].=getPositionForm($f);   
  }  
     
  template($param);


