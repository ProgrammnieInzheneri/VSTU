<?php
function getEmployeeForm($data=array())
{
	global $config;
	
	$Id=			0;
	$FullName= '';
	$Title=		'';
	$Action=		'';
	$Method=		'post';
	$FormTitle=		'Новый сотрудник';
	$SubmitTitle=	'OK';
	$ShowCancel=	FALSE;
	$CancelTitle=	'Отмена';
	if (isset($_SERVER['HTTP_REFERER']))
		$CancelHref=$_SERVER['HTTP_REFERER'];
	else
		$CancelHref=$config['site_url']."employee.php";
	extract($data);
	
	$a['Query'] = 'SELECT Id, FullName FROM person ORDER BY FullName';
	$a['SelectName'] = 'Id_Person';
	$a['ValueField'] = 'FullName';
	$sel1 = getHtmlSelectForDbTableField($a);
     
	
	$a['Query'] = 'SELECT Id, Title FROM position ORDER BY Title';
	$a['SelectName'] = 'Id_Position';
	$a['ValueField'] = 'Title';
	$sel2 = getHtmlSelectForDbTableField($a);
	
	$c='';
	
	if ($ShowCancel)
		$c='
			<div class="col-md-4"></div>
			<div class="col-md-2">
				<a class="form-control btn btn-default" href="'.$CancelHref.'">'.$CancelTitle.'</a>
			</div>
			<div class="col-md-2">
				<input class="form-control btn btn-info" type="submit" value="'.$SubmitTitle.'"/>
			</div>';
	else
		$c='
			<div class="col-md-4"></div>
			<div class="col-md-4 ">
				<input class="form-control btn btn-info" type="submit" value="Добавить"/>
			</div>';
	return '<h3 class="col-md-12 text-center">'.$FormTitle.'</h3>
	<form action="'.$Action.'" method="'.$Method.'">
		<input name="Id" type="hidden" value="'.$Id.'"/>
		
		
		 
		<div class="row form-group">
				<div class="col-md-4"></div>
				<label for="FullName"class="control-label  col-md-1">Ф.И.О</label>
				<div class="col-md-3">			
					'.$sel1.' 
				</div> 
				
		</div>
		<div class="row form-group">
			<div class="col-md-4"></div>
				<label for="Title"class="control-label  col-md-1">Должности</label>
			<div class="col-md-3">			
				'.$sel2.'
			</div>
		</div>
		<div class="row">
			'.$c.'
		</div>
	</form>'; 

}

function getEmployeeSearchForm()
{
  $fields=array(
    'Employee_Id',
    'Person_FullName',
    'Position_Title');
  return getSearchForm($fields);
}
function getEmployeeSearchQueryConditions($request=array())
{
  if (empty($request))
    $request=$_GET;

  $a=array(
    'Employee_Id'    => 'Employee.Id',
    'Person_FullName' => 'Person.FullName',
	'Position_Title' => 'Position.Title',
  );
  
  $q='';
  foreach ($request as $Key => $Value)
  {
    if (isset($a[$Key]))
      if (is_string($a[$Key]))  
        $q.=' AND '.$a[$Key].' LIKE "%'.addslashes($Value).'%"';
      elseif (is_array($a[$Key]))
      {
        $q.=' AND (';
        foreach ($a[$Key] as $field)
          $q.=$field.' LIKE "%'.addslashes($Value).'%" OR ';
        $q=substr($q,0,-4);
        $q.=') ';
      }
  }
  return $q;
}
function getEmployeeModificatedForSearchingQuery($Query)
{
  $SearchRules='';
  if (isset($_GET['Search']))
  {
    if (!stripos($Query,'where'))
      $SearchRules=' WHERE 1 ';
    $SearchRules.=getEmployeeSearchQueryConditions();
  }
  return $Query.$SearchRules;
}