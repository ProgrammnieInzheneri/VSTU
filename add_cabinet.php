<?php
  require_once 'bootstrap.php';
  
  if (checkAdminAndRedirectIfNot())
  {
    if (checkСabinetData())
	{
		$q='INSERT INTO cabinet (Title,Id_Housing,Floor) VALUES 
			("'.addslashes($_POST['Title']).'",
			"'.((int)$_POST ['Id_Housing']).'",
			 "'.addslashes($_POST['Floor']).'")';
		//echo $q;
      mysqli_query($link, $q);
	}
  }
  header('location:'.$config['site_url'].'cabinet.php');
