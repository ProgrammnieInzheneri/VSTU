<?php
function getSubscriberForm($data=array())
{
	global $config;
	
	$Id=			0;
	$Email= 		'';
	$InterOfficePhone='';
	$FullName= 		'';
	$Phone= 		'';
	$FullName=		'';
	$Id_Employee= 	0;
	$Id_Cabinet= 	0;
	$Id_Department =0;
	$Action=		'';
	$Method=		'post';
	$FormTitle=		'';
	$SubmitTitle=	'OK';
	$ShowCancel=	FALSE;
	$CancelTitle=	'Отмена';
	if (isset($_SERVER['HTTP_REFERER']))
		$CancelHref=$_SERVER['HTTP_REFERER'];
	else
		$CancelHref=$config['site_url']."index.php";
	
	extract($data);
	
	$a['SelectName'] = 'Id_Department';
	$a['SelectedId'] = $Id_Department;
	$department = getDepartmentsAsHtmlSelect($a);
	
	$a['Query'] = 'SELECT Employee.Id,CONCAT(Title," ",FullName) as EmployeeName 
					FROM Position,Person,Employee
					WHERE Employee.Id_Position=Position.Id 
					AND  Employee.Id_Person=Person.Id
					ORDER BY Title,FullName';
	$a['SelectName'] = 'Id_Employee';
	$a['ValueField'] = 'EmployeeName';
	$a['SelectedId'] = $Id_Employee;
	$employee=getHtmlSelectForDbTableField($a);

	
	$a['Query'] = 'SELECT Id, Title FROM Cabinet ORDER BY Title';
	$a['SelectName'] = 'Id_Cabinet';
	$a['ValueField'] = 'Title';
	$a['SelectedId'] = $Id_Cabinet;
	$cabinet=getHtmlSelectForDbTableField($a);
	
	

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
				<label for="FullName"class="control-label  col-md-1">Род. подр.</label>
				<div class="col-md-3">			
					'.$department.' 
				</div> 
				
		</div>
		
		<div class="row form-group">
			<div class="col-md-4"></div>
				<label for="Title"class="control-label  col-md-1">Сотрудник</label>
			<div class="col-md-3">			
				'.$employee.'
			</div>
		</div>
		
		<div class="row form-group">
			<div class="col-md-4"></div>
				<label for="Title"class="control-label  col-md-1">Кабинет</label>
			<div class="col-md-3">			
				'.$cabinet.'
			</div>
		</div>

		
		<div class="row form-group">
				<div class="col-md-4"></div>
				<label for="Phone"class="control-label  col-md-1">Телефон</label>
				<div class="col-md-3">			
					<input type="text" id="Phone" name= "Phone" class="form-control" value="'.$Phone.'"/>
				</div>
		</div>

		<div class="row form-group">
				<div class="col-md-4"></div>
				<label for="InterOfficePhone"class="control-label  col-md-1">Вн. тел.</label>
				<div class="col-md-3">			
					<input type="text" id="InterOfficePhone" name= "InterOfficePhone" class="form-control" value="'.$InterOfficePhone.'"/>
				</div>
		</div>
		
		
		<div class="row form-group">
				<div class="col-md-4"></div>
				<label for="Email"class="control-label  col-md-1">Email</label>
				<div class="col-md-3">			
					<input type="text" id="Email" name= "Email" class="form-control" value="'.$Email.'"/>
				</div>
		</div>

		<div class="row">
			'.$c.'
		</div>
	</form>'; 

}
function getSearchQueryConditions($request=array())
{
  if (empty($request))
    $request=$_GET;

  $a=array(
    'Subscriber_Id'    => 'Subscriber.Id',
    'Department_Title' => 'Department.Title',
    'Employee'         => array(
        'Person.FullName',
        'Position.Title'
      ),
    'Cabinet'          => array(
        'Cabinet.Title',
        'Housing.Abbreviation'
      ),
    'Phone'            => 'Subscriber.Phone',
    'InterofficePhone' => 'Subscriber.InterofficePhone',
    'Email'            => 'Subscriber.Email',
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


function getSubscriberSearchForm()
{
  $fields=array(
    'Subscriber_Id',
    'Employee',
    'Cabinet',
    'Department_Title',
    'Phone',
    'InterofficePhone',
    'Email');
  return getSearchForm($fields);
}
function getModificatedForSearchingQuery($Query)
{
  $SearchRules='';
  if (isset($_GET['Search']))
  {
    if (!stripos($Query,'where'))
      $SearchRules=' WHERE 1 ';
    $SearchRules.=getSearchQueryConditions();
  }
  return $Query.$SearchRules;
}


