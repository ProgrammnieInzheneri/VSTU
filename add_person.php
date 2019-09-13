<?php
  require_once 'bootstrap.php';
  
  if (checkAdminAndRedirectIfNot())
  {
    if (checkPersonData())
	{
		$q='INSERT INTO person (FullName) VALUES 
		("'.addslashes($_POST['FullName']).'")';
		//echo $q;
      mysqli_query($link, $q);
	}
  }
  header('location:'.$config['site_url'].'person.php');
