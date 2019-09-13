<?php
  require_once 'bootstrap.php';
  
  if (checkAdminAndRedirectIfNot())
  {
    if (checkSubscriberData())
	{
		$q='INSERT INTO Subscriber (Id_Department,Id_Employee,Id_Cabinet,Phone,InterOfficePhone,Email) VALUES 
			("'.((int)$_POST ['Id_Department']).'",
			"'.((int)$_POST ['Id_Employee']).'",
			"'.((int)$_POST ['Id_Cabinet']).'",
			"'.addslashes($_POST['Phone']).'",
			"'.addslashes($_POST['InterOfficePhone']).'",
			"'.addslashes($_POST['Email']).'"
			 )';
		// echo $q;
      mysqli_query($link, $q);
	}
  }
  header('location:'.$config['site_url'].'index.php');
