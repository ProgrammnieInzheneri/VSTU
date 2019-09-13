<?php
  require_once 'bootstrap.php';
  
  if (checkAdminAndRedirectIfNot())
  {
    if (checkId($_GET))
    {
      if (issetEmployeeData($_GET))
      {
        mysqli_query($link,
          'UPDATE Employee SET 
             Id_Person="'.addslashes($_GET['Id_Person']).'",
			 Id_Position="'.addslashes($_GET['Id_Position']).'"
           WHERE Id='.$_GET['Id']);
        goBack(2); 
      }
      else
      {
        $param['title']='Сотрудники - редактирование';
        if ($f=getRecord($_GET['Id'],'Employee'))
        {
          $f['Method']='get';
          $f['SubmitTitle']='Сохранить';
          $f['ShowCancel']=TRUE;
          $f['FormTitle']='Сотрудники - редактирование';
          $param['content']=getEmployeeForm($f);
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
