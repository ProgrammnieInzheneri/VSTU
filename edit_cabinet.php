<?php
  require_once 'bootstrap.php';
  
  if (checkAdminAndRedirectIfNot())
  {
    if (checkId($_GET))
    {
      if (issetCabinetData($_GET))
      {
        mysqli_query($link,
          'UPDATE Cabinet SET 
             Title="'.addslashes($_GET['Title']).'",
			 Id_Housing="'.addslashes($_GET['Id_Housing']).'",
			 Floor="'.addslashes($_GET['Floor']).'"
			 
           WHERE Id='.$_GET['Id']);
        goBack(2); 
      }
      else
      {
        $param['title']='Кабинеты - редактирование';
        if ($f=getRecord($_GET['Id'],'Cabinet'))
        {
          $f['Method']='get';
          $f['SubmitTitle']='Сохранить';
          $f['ShowCancel']=TRUE;
          $f['FormTitle']='Кабинеты - редактирование';
          $param['content']=getCabinetForm($f);
        }
        else
        {
          $param['content']='Нет записи с Id='.$_GET['Id'];          
        }
        template($param);
      }
    }
    else
    {
      goBack();    
    }
  }
