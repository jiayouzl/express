<?php
require ('./Class/Express.class.php');
header('Content-Type:text/html; charset=utf-8');
$express = new Express();
$result  = $express -> getorder('111309582915');
var_dump($result);
?>
