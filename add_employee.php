<?php
  require_once 'bootstrap.php';
  
  if (checkAdminAndRedirectIfNot())
  {
    if (checkEmployeeData())
	{
		$q='INSERT INTO Employee (Id_Person,Id_Position) VALUES 
			("'.((int)$_POST ['Id_Person']).'",
			 "'.((int)$_POST ['Id_Position']).'")';
		//echo $q;
      mysqli_query($link, $q);
	}
  }
  header('location:'.$config['site_url'].'employee.php');
