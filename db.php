<?php
function getRecord($id,$tab)
{
	global $link ;
	$t = 'SELECT * FROM  '.$tab.' WHERE id= '.((int)$id);
	$r = mysqli_query($link, $t);
	if ($r){
		return mysqli_fetch_assoc($r);
	}else
			return FALSE;
		
}
