<?php
  require_once 'bootstrap.php';
  
  if (checkAdminAndRedirectIfNot())
  {
    if (checkId($_GET))
    {
      if (issetPositionData($_GET))
      {
        mysqli_query($link,
          'UPDATE Position SET 
             Title="'.addslashes($_GET['Title']).'" 
           WHERE Id='.$_GET['Id']);
        goBack(2); 
      }
      else
      {
        $param['title']='Должности - редактирование';
        if ($f=getRecord($_GET['Id'],'position'))
        {
          $f['Method']='get';
          $f['SubmitTitle']='Сохранить';
          $f['ShowCancel']=TRUE;
          $f['FormTitle']='Должности - редактирование';
          $param['content']=getPositionForm($f);
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
