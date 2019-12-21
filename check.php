<?php

/**
* Функция для проверки формальной корректности учетных данных
* Если параметр не задан или массив пуст, используется $_POST
*
* @param array  $data  Массив с данными для проверки. 
*/
function checkAdminData($data=array())
{
  if (empty($data))
    $data=$_POST;
  if (isset($data['Name'],$data['Login'],$data['Password'])
      AND (strlen(trim($data['Name']))>0)
      AND (strlen(trim($data['Login']))>0))
    return TRUE;
  else
    return FALSE;
}

/**
* Функция для проверки формальной корректности учетных данных и Id
* Если параметр не задан или массив пуст, используется $_POST
*
* @param array  $data  Массив с данными для проверки. 
*/
function checkAdminDataAndId($data=array())
{
  if (empty($data))
    $data=$_POST;
  if (checkAdminData($data)
      AND isset($data['Id'])
      AND (is_numeric($data['Id'])))
	  
    return TRUE;
  else
    return FALSE;
}

function checkId($data=array())
{
  if (empty($data))
    $data=$_POST;
  if (isset($data['id'])
      AND (is_numeric($data['id'])))
    return TRUE;
  else
    return FALSE;
}

function checkRegistrationData($data=array())
{
  if (empty($data))
    $data=$_POST;

  if (isset(
    $_POST['name'],
    $_POST['login'],
    $_POST['password'],
    $_POST['email']) &&
    strlen(trim($data['name'])) > 0 &&
    strlen(trim($data['login'])) > 0 &&
    strlen(trim($data['password'])) > 0 &&
    strlen(trim($data['email'])) > 0)
  {
    return TRUE;
  }
  else 
  {
    return FALSE;
  }
}

function checkPaymentData($data = array())
{
  if (empty($data))
        $data=$_POST;
  
  if (isset($data['projectId'], $data['sum'], $data['paymentMethod']) &&
    is_numeric($data['sum']))
  {
    return true;
  }
  else
  {
    return false;
  }
}

function checkProjectData($data=array())
{
    if (empty($data))
        $data=$_POST;
    if (isset($data['name'], $data['description'], $data['requestedFunds'], $data['period'])
        AND (strlen(trim($data['name']))>0) AND (strlen(trim($data['description']))>0))
        return TRUE;
    else
        return FALSE;
}