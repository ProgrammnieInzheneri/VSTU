<?php
require_once 'bootstrap.php';

if (checkPaymentData())
{
    if (isset($_SESSION['Id']))
    {
        $sessionId = $_SESSION['Id'];
    }
    else
    {
        $sessionId = -1;
    }

    $projectId = $_POST['projectId'];
    $sum = $_POST['sum'];
    $paymentMethod = $_POST['paymentMethod'];

    mysqli_multi_query($link,
        'UPDATE projects SET 		  
        currentFunds = currentFunds + '.$sum.' 			 
        WHERE id='.$projectId.';
        INSERT INTO payments (userId, projectId, sum) VALUES ('.$sessionId.', '.$projectId.', '.$sum.')');

    goBack(2);
}
else
{
    goBack(1);
}
