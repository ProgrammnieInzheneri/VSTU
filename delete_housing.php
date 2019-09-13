<?php
  require_once 'bootstrap.php';
  
  if (checkAdminAndRedirectIfNot())
  {
	 
    if (isset($_GET['Id']))
	
      mysqli_query($link, 
        'DELETE FROM housing WHERE Id='.((int)$_GET['Id']));	
  }
  goBack();
