<?php
  require_once 'bootstrap.php';
  
  if (checkAdminAndRedirectIfNot())
  {
    if (checkId($_GET))
    {      
      $Result=mysqli_query($link,
       'SELECT * FROM department WHERE Id='.$_GET['Id']);   
      if ($Row=mysqli_fetch_assoc($Result))
      {
        $Path=$Row['Path'];
        mysqli_query($link,
          'DELETE FROM department WHERE Path LIKE "'.$Path.'%"');
      }
    }
  }
  goBack();
