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
      AND (strlen(trim($data['Login']))>0)
      AND (strlen(trim($data['Password']))>0))
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

function checkPersonData($data=array())
{
  if (empty($data))
    $data=$_POST;
  if (issetPersonData($data) AND (strlen($data['FullName'])>0))
    return TRUE;
  else
    return FALSE;
}

function issetPersonData($data=array())
{
  if (empty($data))
    $data=$_POST;
  if (isset($data['FullName']))
    return TRUE;
  else
    return FALSE;
}

function checkId($data=array())
{
  if (empty($data))
    $data=$_POST;
  if (isset($data['Id'])
      AND (is_numeric($data['Id'])))
    return TRUE;
  else
    return FALSE;
}

function checkPositionData($data=array())
{
  if (empty($data))
    $data=$_POST;
  if (issetPositionData($data) AND (strlen($data['Title'])>0))
    return TRUE;
  else
    return FALSE;
}

function issetPositionData($data=array())
{
  if (empty($data))
    $data=$_POST;
  if (isset($data['Title']))
    return TRUE;
  else
    return FALSE;
}

function checkEmployeeData($data=array())
{
  if (empty($data))
    $data=$_POST;
  if (isset ($data['Id'],$data['Id_Person'],$data['Id_Position']) 
	  AND (strlen(trim($data['Id_Person']))>0) 
	  AND (strlen(trim($data['Id_Position']))>0) 
	  )
	  return TRUE;
  else
    return FALSE;
}

function issetEmployeeData($data=array())
{
  if (empty($data))
    $data=$_POST;
  if (isset($data['Id'],$data['Id_Person'],$data['Id_Position']))
    return TRUE;
  else
    return FALSE;
}




function checkHousingData($data=array())
{
  if (empty($data))
    $data=$_POST;
if (isset($data['Id'],$data['Address'],$data['Title'],$data['Abbreviation'])
      AND (strlen(trim($data['Address']))>0)
      AND (strlen(trim($data['Title']))>0)
      AND (strlen(trim($data['Abbreviation']))>0))
    return TRUE;
  else
    return FALSE;
}

function issetHousingData($data=array())
{
  if (empty($data))
    $data=$_POST;
  if (isset($data['Id'],$data['Address'],$data['Title'],$data['Abbreviation']))
    return TRUE;
  else
    return FALSE;
}


function checkСabinetData($data=array())
{
  if (empty($data))
    $data=$_POST;
if (isset($data['Id'],$data['Title'],$data['Id_Housing'],$data['Floor'])
      AND (strlen(trim($data['Title']))>0)
      AND (strlen(trim($data['Id_Housing']))>0)
      AND (strlen(trim($data['Floor']))>0))
    return TRUE;
  else
    return FALSE;
}

function issetCabinetData($data=array())
{
  if (empty($data))
    $data=$_POST;
  if (isset($data['Id'],$data['Title'],$data['Id_Housing'],$data['Floor']))
    return TRUE;
  else
    return FALSE;
}


function checkDepartmentData($data=array())
{
  if (empty($data))
    $data=$_POST;
if (isset($data['Title'])
      AND (strlen(trim($data['Title']))>0))
    return TRUE;
  else
    return FALSE;
}

function issetDepartmentData($data=array())
{
  if (empty($data))
    $data=$_POST;
  if (isset($data['Title']))
    return TRUE;
  else
    return FALSE;
}


function checkSubscriberData($data=array())
{
  if (empty($data))
    $data=$_POST;


if (issetSubscriberData($data)
      AND (strlen(trim($data['Phone']))>0)
      AND (strlen(trim($data['InterOfficePhone']))>0)
      AND (strlen(trim($data['Email']))>0))

    return TRUE;
  else
    return FALSE;
}

function issetSubscriberData($data=array())
{
  if (empty($data))
    $data=$_POST;
if (isset($data['Phone'],$data['InterOfficePhone'],$data['Email']))
    return TRUE;
  else
    return FALSE;
}