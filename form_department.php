
<?php
function getDepartmentForm($data=array())
{
	global $config;
	
	$Id=			0;
	$Title=			'';
	$Action=		'';
	$Method=		'post';
	$FormTitle=		' Новое подразделение';
	$SubmitTitle=	'OK';
	$ShowCancel=	FALSE;
	$CancelTitle=	'Отмена';
	if (isset($_SERVER['HTTP_REFERER']))
		$CancelHref=$_SERVER['HTTP_REFERER'];
	else
		$CancelHref=$config['site_url']."department.php";
	extract($data);
	
	
	$sel1 = getDepartmentsAsHtmlSelect();
	
	$c='';
	if ($ShowCancel)	
		$c='<div class="row form-group">
				<div class="col-sm-6">
					<input  class="form-control btn btn-info" type="submit" value="'.$SubmitTitle.'"/>
				</div>
				<div class="col-sm-6">
					<a class="form-control btn btn-warning" href="'.$CancelHref.'">'.$CancelTitle.'</a>
				</div>
			</div>';
	else
		$c='<div class="row form-group">
				<div class="col-sm-offset-3 col-sm-6">
					<input  class="form-control btn btn-info" type="submit" value="'.$SubmitTitle.'"/>
				</div>
			</div>';
	return '<h3><center>'.$FormTitle.'</center></h3>
		<div class="row">
		<form action="'.$Action.'" method="'.$Method.'" class=" col-sm-offset-3 col-sm-6">
		<input name="Id" type="hidden" value="'.$Id.'"/>

		
		<div class="row form-group">
				<div class="col-md-0"></div>
				<label for="Title" class="control-label col-md-3" >Род.подр.</label> 
				<div class="col-md-6">			
					'.$sel1.' 
				</div> 
		</div>
		<div class="row form-group">
				<label for="Title" class="control-label col-sm-3" >Название</label> 
				<div class="col-sm-6 ">	
				<input type="text" id="Title" name="Title" class="form-control" value="'.$Title.'"/>
				</div>
		</div>		
	
		'.$c.'		
	</form>
	</div>';

}

function getDepartmentSearchForm()
{
  $fields=array(
    'Department_Id',
    'Title',
    'Path');
  return getSearchForm($fields);
}
function getDepartmentSearchQueryConditions($request=array())
{
  if (empty($request))
    $request=$_GET;

  $a=array(
    'Department_Id' => 'Department.Id',
    'Title' 		=> 'Department.Title',
	'Path' 			=> 'Department.Path',
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
function getDepartmentModificatedForSearchingQuery($Query)
{
  $SearchRules='';
  if (isset($_GET['Search']))
  {
    if (!stripos($Query,'where'))
      $SearchRules=' WHERE 1 ';
    $SearchRules.=getDepartmentSearchQueryConditions();
  }
  return $Query.$SearchRules;
}