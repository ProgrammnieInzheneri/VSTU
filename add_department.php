<?php

  require_once 'bootstrap.php';
  
  if (checkAdminAndRedirectIfNot())
  {
    if (checkDepartmentData())
      if ($_POST['Id_Parent']==0)
      {
        mysqli_query($link,
          'INSERT INTO department (Title) 
           VALUES ("'.$_POST['Title'].'")');
        mysqli_query($link,
          'UPDATE department 
           SET path = CONCAT(LAST_INSERT_ID() , "/") 
           WHERE Id = LAST_INSERT_ID()');
      }
      else
      {
        mysqli_query($link,
          'INSERT INTO department (Title) 
           VALUES ("'.$_POST['Title'].'")');
        $id=mysqli_insert_id($link);
        $result=mysqli_query($link,
          'SELECT Path FROM department 
           WHERE id = '.$_POST['Id_Parent']);
        $row=mysqli_fetch_assoc($result);
        mysqli_query($link,'UPDATE department SET path = 
          CONCAT("'.$row['Path'].'", '.$id.' , "/") 
          WHERE Id = '.$id);
      }        
  }
  header('location:'.$config['site_url'].'/department.php');
