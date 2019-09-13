<?php
  require_once 'bootstrap.php';
  
  if (checkAdminAndRedirectIfNot())
  {
    if (checkPositionData())
      mysqli_query($link, 
        'INSERT INTO Position (Title) VALUES ("'.
           addslashes($_POST['Title']).'")');
  }
  header('location:'.$config['site_url'].'position.php');
