<?php
require_once 'form_person.php';
require_once 'form_position.php';
require_once 'form_employee.php';
require_once 'form_housing.php';
require_once 'form_cabinet.php';
require_once 'form_department.php';
require_once 'form_subscriber.php';


function getSearchForm($fields)
{
  $c='<form>';
  foreach ($fields as $field) 
  {  
    if (!(strpos($field,'Id')===FALSE))
      if (!isAdmin())
        continue;
    $c.='<th><input class="form-control" type="text" 
      name="'.$field.'" value="'.htmlentities(_a($_GET,$field)).'"/></th>';
  }      
  $c.=
        '<th>
          <input class="form-control btn-primary" name="Search" type="submit" value="=">
        </th>
      </form>
        <th>
          <form>
            <input class="form-control btn-warning" type="submit" value="X">
          </form>
        </th>
      </tr>
      <tr>';
  return $c;
}



