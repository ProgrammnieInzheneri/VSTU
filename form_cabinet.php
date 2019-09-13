<?php
function getCabinetForm($data=array())
{
	global $config;
	
	$Id=			0;
	$Id_Housing=			0;
	$FullName= 	'';
	$Floor=		'';
	$Title=		'';
	$Action=		'';
	$Method=		'post';
	$FormTitle=		'Новый кабинет';
	$SubmitTitle=	'OK';
	$ShowCancel=	FALSE;
	$CancelTitle=	'Отмена';
	if (isset($_SERVER['HTTP_REFERER']))
		$CancelHref=$_SERVER['HTTP_REFERER'];
	else
		$CancelHref=$config['site_url']."сabinet.php";
	extract($data);
	
	$a['Query'] = 'SELECT Id, Title FROM Housing ORDER BY Title';
	$a['SelectName'] = 'Id_Housing';
	$a['ValueField'] = 'Title';
	$sel1 = getHtmlSelectForDbTableField($a);
     
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
			<label for="Title" class="control-label col-sm-3" >Кабинет</label> 
			<div class="col-sm-6 ">	
			<input type="text" id="Title" name="Title" class="form-control btn-block" value="'.$Title.'"/>
			</div>
		</div>
		 
		<div class="row form-group">
				<div class="col-md-0"></div>
				<label for="Title"class="control-label  col-md-3">Корпус</label>
				<div class="col-md-6">			
					'.$sel1.' 
				</div> 
				
		</div>
		
		<div class="row form-group">
			<label for="Floor" class="control-label col-sm-3" >Этаж</label> 
			<div class="col-sm-6 ">	
			<input type="text" id="Floor" name="Floor" class="form-control btn-block" value="'.$Floor.'"/>
			</div>
		</div>
		
		<div class="row">
			'.$c.'
		</div>
	</form>'; 

}
function getCabinetSearchForm()
{
  $fields=array(
    'Cabinet_Id',
    'Title',
    'Housing_Title',
    'Floor');
  return getSearchForm($fields);
}

function getCabinetSearchQueryConditions($request=array())
{
  if (empty($request))
    $request=$_GET;

  $a=array(
    'Cabinet_Id'    => 'Cabinet.Id',
    'Title' 		=> 'Cabinet.Title',
	'Housing_Title' => 'Housing.Title',
	'Floor' 		=> 'Cabinet.Title',
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
function getCabinetModificatedForSearchingQuery($Query)
{
  $SearchRules='';
  if (isset($_GET['Search']))
  {
    if (!stripos($Query,'where'))
      $SearchRules=' WHERE 1 ';
    $SearchRules.=getCabinetSearchQueryConditions();
  }
  return $Query.$SearchRules;
}