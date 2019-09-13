<?php
function getRecord($Id,$tab)
{
	global $link ;
	$t = 'SELECT * FROM  '.$tab.' WHERE Id= '.((int)$Id);
	$r = mysqli_query($link, $t);
	if ($r){
		return mysqli_fetch_assoc($r);
	}else
			return FALSE;
		
}
function getDepartment ($Id)
{
		return getRecord ($Id,'department');
}
function getPosition($Id)
{
	return getRecord($Id, 'position');		
}

function getEmployee($Id)
{
	return getRecord($Id, 'employee');		
}	

function getHousing($Id)
{
	return getRecord($Id, 'housing');		
}	

function getCabinet($Id)
{
	return getRecord($Id, 'cabinet');		
}	

function getSubscriber($Id)
{
	return getRecord($Id, 'subscriber');		
}	

