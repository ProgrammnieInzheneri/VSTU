
<?php
function getPositionForm($data=array())
{
	global $config;
	
	$Id=			0;
	$Title=		'';
	$Action=		'';
	$Method=		'post';
	$FormTitle=		'';
	$SubmitTitle=	'OK';
	$ShowCancel=	FALSE;
	$CancelTitle=	'Отмена';
	if (isset($_SERVER['HTTP_REFERER']))
		$CancelHref=$_SERVER['HTTP_REFERER'];
	else
		$CancelHref=$config['site_url']."position.php";
	extract($data);
	
	$c='';
	if ($ShowCancel)
		$c='
	<div class="col-sm-2"><a class="btn btn-default  " href="'.$CancelHref.'">'.$CancelTitle.'</a>';
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
				<div class="col-sm-offset-2 col-sm-8">
					<input  class="form-control btn btn-info" type="submit" value="'.$SubmitTitle.'"/>
				</div>
			</div>';
	return '<h3><center>'.$FormTitle.'</center></h3>
	<div class="row">
	<form action="'.$Action.'" method="'.$Method.'" class=" col-sm-offset-3 col-sm-6">
		<input name="Id" type="hidden" value="'.$Id.'"/>

		<div class="row form-group">
			<label for="Title" class="control-label col-sm-2" >Должности</label> 
			<div class="col-sm-8 ">	
			<input type="text" id="Title" name="Title" class="form-control btn-block" value="'.$Title.'"/>
			</div>
		</div>		
		'.$c.'		
	</form>
	</div>';

}
function getPositionSearchForm()
{
  $fields=array(
    'Position_Id',
    'Title');
  return getSearchForm($fields);
}
function getPositionSearchQueryConditions($request=array())
{
  if (empty($request))
    $request=$_GET;

  $a=array(
    'Position_Id'    => 'Position.Id',
	'Title'            => 'Position.Title'
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
function getPositionModificatedForSearchingQuery($Query)
{
  $SearchRules='';
  if (isset($_GET['Search']))
  {
    if (!stripos($Query,'where'))
      $SearchRules=' WHERE 1 ';
    $SearchRules.=getPositionSearchQueryConditions();
  }
  return $Query.$SearchRules;
}