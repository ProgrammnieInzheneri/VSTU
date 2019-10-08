<?php
require_once '../bootstrap.php';

function getRecordsAsJson($table, $conditionsArr = array())
{
    global $link;
    
    $fetchedResult = array('status' => true, 'data' => array());
    
    $conditions = ' WHERE 1 ';
    foreach ($conditionsArr as $key => $vector)
    {
        foreach ($vector as $operator => $value)
        $conditions .= 'AND '.$key.$operator.$value.' ';
    }
    $query=
        'SELECT * FROM '.$table.$conditions;
        
    if ($result=mysqli_query($link,$query))
    {
        while ($row = mysqli_fetch_assoc($result))
        {
                array_push($fetchedResult['data'], $row);
        }
    }
    else
    {
        $fetchedResult['status'] = false;
        $fetchedResult['error'] = mysqli_error($link);
    }
    return json_encode($fetchedResult, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
}