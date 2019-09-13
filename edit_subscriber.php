<?php
  require_once 'bootstrap.php';
  
  if (checkAdminAndRedirectIfNot())
  {
    if (checkId($_GET))
    {
      if (issetSubscriberData($_GET))
      {
        mysqli_query($link,
          'UPDATE Subscriber SET 
		  
			Id_Department="'.addslashes($_GET['Id_Department']).'",
			Id_Employee="'.addslashes($_GET['Id_Employee']).'",
			Id_Cabinet="'.addslashes($_GET['Id_Cabinet']).'",
            Phone="'.addslashes($_GET['Phone']).'",
			InterOfficePhone="'.addslashes($_GET['InterOfficePhone']).'",
			Email="'.addslashes($_GET['Email']).'"
			 
           WHERE Id='.$_GET['Id']);
        goBack(2); 
      }
      else
      {
        $param['title']='Абоненты - редактирование';
        if ($f=getRecord($_GET['Id'],'Subscriber'))
        {
          $f['Method']='get';
          $f['SubmitTitle']='Сохранить';
          $f['ShowCancel']=TRUE;
          $f['FormTitle']='Абоненты- редактирование';
          $param['content']=getSubscriberForm($f);
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
