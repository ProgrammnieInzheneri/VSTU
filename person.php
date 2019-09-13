<?php
  require_once 'bootstrap.php';
 
    $param['title']='Кадры';
	
	$Query=
	'SELECT 
      Person.Id AS Id,
      Person.FullName AS "ФИО"
    FROM Person';
	$Query=getPersonModificatedForSearchingQuery($Query);
	Pagination($Query,$Navigation,5);
	$p['title']='Кадры';
	$p['editHref']='edit_person.php';
	$p['deleteHref']='delete_person.php';
	$p['tableTitleClass']='lead text-center';
	$p['tableClass']='table table-striped table-center';
	$p['searchForm']=getPersonSearchForm();
	$p['Navigation']=$Navigation;
	$param['content']=getDBTableAsHTML($Query,$p);
	
	if (isAdmin())
	{
		$f['Action']='add_person.php';
		$f['SubmitTitle']='Добавить';
		$param['content'].=getPersonForm($f);   
	}  
  template($param);
