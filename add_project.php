<?php
  require_once 'bootstrap.php';
  
  if (checkAdminAndRedirectIfNot())
  {
    if (checkProjectData())
	{
		$q='INSERT INTO projects (
                userId,
                name,
                description,
                requestedFunds,
                period)
            VALUES  
                ("'.$_SESSION['Id'].'",
                "'.addslashes($_POST['name']).'",
                "'.addslashes($_POST['description']).'",
                "'.addslashes($_POST['requestedFunds']).'",
                "'.addslashes($_POST['period']).'")';
        mysqli_query($link, $q);

        $lastId = mysqli_insert_id($link);
        $q = 'INSERT INTO updates (tableName, operation, rowId) VALUES ("projects", "add", '. $lastId .')';
        mysqli_query($link, $q);
	}
  }
//goBack();
header('location:'.$config['site_url']);
