<?php
  require_once 'bootstrap.php';
  
  if (checkAdminAndRedirectIfNot())
  {
    if (checkId($_GET))
    {
      if (issetHousingdata($_GET))
      {
        mysqli_query($link,
          'UPDATE Housing SET 
             Address="'.addslashes($_GET['Address']).'" ,
			 Title="'.addslashes($_GET['Title']).'" ,
			 Abbreviation="'.addslashes($_GET['Abbreviation']).'" 
           WHERE Id='.$_GET['Id']);
        goBack(2); 
      }
      else
      {
        $param['title']='Корпуса - редактирование';
        if ($f=getRecord($_GET['Id'],'Housing'))
        {
          $f['Method']='get';
          $f['SubmitTitle']='Сохранить';
          $f['ShowCancel']=TRUE;
          $f['FormTitle']='Корпуса - редактирование';
          $param['content']=getHousingForm($f);
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
