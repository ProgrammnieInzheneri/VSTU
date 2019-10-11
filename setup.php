<?php
  require_once 'bootstrap.php';
  
  $result=mysqli_query($link,'SELECT COUNT(*) FROM admin');
  $row=mysqli_fetch_row($result);
  if ($row[0]!==0)
  {
    $q='INSERT INTO admin (Login,Password,Name) VALUES '.
      '("admin","'.getHash('admin').'","admin")';
    mysqli_query($link,$q);
    echo 'Установка произведена';
  }
  else
  {
    echo 'Установка невозможна';
  }

