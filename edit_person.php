<?php
  require_once 'bootstrap.php';
  
  if (checkAdminAndRedirectIfNot())
  {
    if (checkId($_GET))
    {
      if (issetPersonData($_GET))
      {
        mysqli_query($link,
          'UPDATE Person SET 
             FullName="'.addslashes($_GET['FullName']).'" 
           WHERE Id='.$_GET['Id']);
        goBack(2); 
      }
      else
      {
        $param['title']='кадры - редактирование';
        if ($f=getRecord($_GET['Id'],'Person'))
        {
          $f['Method']='get';
          $f['SubmitTitle']='Сохранить';
          $f['ShowCancel']=TRUE;
          $f['FormTitle']='кадры - редактирование';
          $param['content']=getPersonForm($f);
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
