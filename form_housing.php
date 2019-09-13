<?php
function getHousingForm($data=array())
{
	global $config;
	
	$Id=			0;
	$Address=		'';
	$Title=			'';
	$Abbreviation=	'';
	$Action=		'';
	$Method=		'post';
	$FormTitle=		' Новый Корпус';
	$SubmitTitle=	'OK';
	$ShowCancel=	FALSE;
	$CancelTitle=	'Отмена';
	if (isset($_SERVER['HTTP_REFERER']))
		$CancelHref=$_SERVER['HTTP_REFERER'];
	else
		$CancelHref=$config['site_url']."housing.php";
	extract($data);
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
				<div class="col-sm-offset-3 col-sm-9">
					<input  class="form-control btn btn-info" type="submit" value="'.$SubmitTitle.'"/>
				</div>
			</div>';
	return '<h3><center>'.$FormTitle.'</center></h3>
	<div class="row">
	<form action="'.$Action.'" method="'.$Method.'" class=" col-sm-offset-3 col-sm-6">
		<input name="Id" type="hidden" value="'.$Id.'"/>

		<div class="row form-group">
			<label for="Address" class="control-label col-sm-3" >Адресс</label> 
			<div class="col-sm-9 ">	
			<input type="text" id="Address" name="Address" class="form-control btn-block" value="'.$Address.'"/>
			</div>
		</div>		
		
		<div class="row form-group">
			<label for="Title" class="control-label col-sm-3" >Корпус</label> 
			<div class="col-sm-9 ">	
			<input type="text" id="Title" name="Title" class="form-control btn-block" value="'.$Title.'"/>
			</div>
		</div>		
		
		<div class="row form-group">
			<label for="Abbreviation" class="control-label col-sm-3" >Сокращение</label> 
			<div class="col-sm-9 ">	
			<input type="text" id="Abbreviation" name="Abbreviation" class="form-control btn-block" value="'.$Abbreviation.'"/>
			</div>
		</div>		
		
		'.$c.'		
	</form>
	</div>';

}

function getHousingSearchForm()
{
  $fields=array(
    'Housing_Id',
	'Address',
	'Title',
	'Abbreviation');
  return getSearchForm($fields);
}
function getHousingSearchQueryConditions($request=array())
{
  if (empty($request))
    $request=$_GET;

  $a=array(
    'Housing_Id'   => 'Housing.Id',
	'Address'      => 'Housing.Address',
	'Title'        => 'Housing.Title',
	'Abbreviation' => 'Housing.Abbreviation',
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
function getHousingModificatedForSearchingQuery($Query)
{
  $SearchRules='';
  if (isset($_GET['Search']))
  {
    if (!stripos($Query,'where'))
      $SearchRules=' WHERE 1 ';
    $SearchRules.=getHousingSearchQueryConditions();
  }
  return $Query.$SearchRules;
}