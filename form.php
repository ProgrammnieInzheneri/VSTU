<?phpfunction getForm($formParams = array(), $fieldParams = array(array()), $savedValues = array()){    global $config;    $id=			0;    $name =         '';    $img =          '';    $number =       null;    $title =        '';    $Action=		'';    $Method=		'post';    $FormTitle=		'';    $SubmitTitle=	'OK';    $ShowCancel=	FALSE;    $CancelTitle=	'Отмена';    $CancelHref =   '';    $hiddenFields = '';    $formFields =   '';    extract($formParams);    foreach ($savedValues as $value)    {        $hiddenFields .= "<input name=\"{$value}\" type=\"hidden\" value=\"{$_GET[$value]}\"/>";    }    foreach ($fieldParams as $key => $vector)    {        foreach ($vector as $placeholder => $value)            $formFields .= "                <div class=\"row form-group\">                    <div class=\"col-sm-8 \">	                        <input type=\"text\"                            name=\"{$key}\"                            class=\"form-control btn-block\"                            placeholder=\"{$placeholder}\"                            value=\"{$value}\"/>                    </div>                </div>";    }    if (isset($_SERVER['HTTP_REFERER']))        $CancelHref = getReferer($_SERVER['HTTP_REFERER']);    else        $CancelHref=$config['site_url'];    $c='';    if ($ShowCancel)        $c='	<div class="col-sm-2"><a class="btn btn-default  " href="'.$CancelHref.'">'.$CancelTitle.'</a>';    if ($ShowCancel)        $c='<div class="row form-group">				<div class="col-sm-6">					<input  class="form-control btn btn-info" type="submit" value="'.$SubmitTitle.'"/>				</div>				<div class="col-sm-6">					<a class="form-control btn btn-warning" href="'.$CancelHref.'">'.$CancelTitle.'</a>				</div>			</div>';    else        $c='<div class="row form-group">				<div class="col-sm-offset-2 col-sm-8">					<input  class="btn btn-primary mb-2" type="submit" value="'.$SubmitTitle.'"/>				</div>			</div>';    return '<h3><center>'.$FormTitle.'</center></h3>	<div class="row">	<form action="'.$Action.'" method="'.$Method.'" class=" col-sm-offset-3 col-sm-6">		'.$hiddenFields		.$formFields		.$c.'			</form>	</div>';}function getSearchForm($fields, $savedValues = array()){    $c='<form>';    foreach ($fields as $field)    {        if (!(strpos($field,'id')===FALSE))            if (!isAdmin())                continue;        $c.='<th><input class="form-control" type="text"       name="'.$field.'" value="'.htmlentities(_a($_GET,$field)).'"/></th>';    }    $hiddenFields = '';    foreach ($savedValues as $value)    {        $hiddenFields .= "<input name=\"{$value}\" type=\"hidden\" value=\"{$_GET[$value]}\"/>";    }    $c.=        '<th>          '. $hiddenFields .'          <input class="form-control btn-primary" name="Search" type="submit" value="Найти">        </th>      </form>      </tr>      <tr>';    return $c;}function getModificatedForSearchingQuery($Query){    $SearchRules='';    if (isset($_GET['Search']))    {        if (!stripos($Query,'WHERE'))            $SearchRules=' WHERE 1 ';        $SearchRules.=getSearchQueryConditions();    }    return $Query.$SearchRules;}function getSearchQueryConditions($request=array()){    if (empty($request))        $request=$_GET;    $a=array(        'subjects_id' => 'subjects.id',        'subjects_name' => 'subjects.name',        'topics_number' => 'topics.number',        'topics_title' => 'topics.title',        'exercisesDescription' => 'exercises.description',        'exercisesRightAnswer' => 'exercises.rightAnswer',        'exercisesVersion' => 'exercises.version',        'directoryTitle' => 'directory_topics.title',        'directoryContent' => 'directory_topics.content'    );    $q='';    foreach ($request as $Key => $Value)    {        if (isset($a[$Key]))            if (is_string($a[$Key]))                $q.=' AND '.$a[$Key].' LIKE "%'.addslashes($Value).'%"';            elseif (is_array($a[$Key]))            {                $q.=' AND (';                foreach ($a[$Key] as $field)                    $q.=$field.' LIKE "%'.addslashes($Value).'%" OR ';                $q=substr($q,0,-4);                $q.=') ';            }    }    return $q;}