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

function checkDirectoryTopicData($data=array())
{
    if (empty($data))
        $data=$_GET;
    if (isset($data['title'], $data['content'])
        AND (strlen(trim($data['title']))>0))
        return TRUE;
    else
        return FALSE;
}

function checkExercisesData($data=array())
{
    if (empty($data))
        $data=$_GET;
    if (isset($data['description'], $data['img'], $data['rightAnswer'])
        AND (strlen(trim($data['description']))>0))
        return TRUE;
    else
        return FALSE;
}

function checkTopicsData($data=array())
{
    if (empty($data))
        $data=$_GET;
    if (isset($data['number'], $data['title'])
        AND (strlen(trim($data['title']))>0))
        return TRUE;
    else
        return FALSE;
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