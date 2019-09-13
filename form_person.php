<?php
function getPersonForm($data=array())
{
	global $config;
	
	$Id=			0;
	$FullName=		'';
	$Action=		'';
	$Method=		'post';
	$FormTitle=		'';
	$SubmitTitle=	'OK';
	$ShowCancel=	FALSE;
	$CancelTitle=	'Отмена';
	if (isset($_SERVER['HTTP_REFERER']))
		$CancelHref=$_SERVER['HTTP_REFERER'];
	else
		$CancelHref=$config['site_url']."person.php";
	extract($data);
	$c='';
	if ($ShowCancel)	
	$c='<a class="btn btn-warning col-sm-2" href="'.$CancelHref.'">'.$CancelTitle.'</a>';
	return '<h3><center>'.$FormTitle.'</center></h3>
	<form action="'.$Action.'" method="'.$Method.'">
		<input name="Id" type="hidden" value="'.$Id.'"/>
		
		<div class="row">
		
			<label for="FullName"class="control-label col-sm-offset-3 col-sm-1" >Ф.И.О</label> 
				<div class="col-sm-4 ">	
				<input type="text" id="FullName" name="FullName"  value="'.$FullName.'"class="form-control btn-block "/>
				<br>
				</div>
		</div>	
        <div class="form-group">		
		<div class="col-sm-offset-2 text-center"'.$SubmitTitle.'"/>
		<div class="col-sm-offset-3 col-sm-3">
		<input  class="form-control btn btn-info" type="submit" value="'.$SubmitTitle.'"/>
		</div>
</div><div class="row">
	'.$c.'</div>
	</form>';

}
function getPersonSearchForm()
{
  $fields=array(
    'Person_Id',
    'FullName');
  return getSearchForm($fields);
}
function getPersonSearchQueryConditions($request=array())
{
  if (empty($request))
    $request=$_GET;

  $a=array(
    'Person_Id'    => 'Person.Id',
    'FullName'     => 'Person.FullName',
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
function getPersonModificatedForSearchingQuery($Query)
{
  $SearchRules='';
  if (isset($_GET['Search']))
  {
    if (!stripos($Query,'where'))
      $SearchRules=' WHERE 1 ';
    $SearchRules.=getPersonSearchQueryConditions();
  }
  return $Query.$SearchRules;
}