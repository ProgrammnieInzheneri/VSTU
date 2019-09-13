<?php
  require_once 'bootstrap.php';
  
  if (checkAdminAndRedirectIfNot())
  {
    if (checkHousingData())
	{
		$q='INSERT INTO housing (Address, Title, Abbreviation) VALUES 
		("'.addslashes($_POST['Address']).'", 
		 "'.addslashes($_POST['Title']).'",
		 "'.addslashes($_POST['Abbreviation']).'")
		';
		//echo $q;
      mysqli_query($link, $q);
	}
  }
  header('location:'.$config['site_url'].'housing.php');
