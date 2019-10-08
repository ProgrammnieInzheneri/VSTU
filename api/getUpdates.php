<?php
require_once 'getRecords.php';

$conditionsArr = array();
if (isset($_GET['afterDate'])) $afterDate = $_GET['afterDate']; else $afterDate = '';
if (isset($_GET['afterTime'])) $afterTime = $_GET['afterTime']; else $afterTime = '';

$tStamp = '"'.$afterDate.' '.$afterTime.'"';
$conditionsArr = $conditionsArr + array('tStamp' => array(">" => $tStamp));

echo getRecordsAsJson('updates', $conditionsArr);