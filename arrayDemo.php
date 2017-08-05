<?php
require ('./Class/Express.class.php');
header('Content-Type:text/html; charset=utf-8');
$express = new Express();
$orderList = array(111309582915,111309582915); //这里放单号，这里放了原作者demo中的单号，但是这个单号是真的查不到。。。。
if(sizeof($orderList)>1){
    $result = $express -> getArrayExpressResult($orderList);
    var_dump($result);
}else{
    $result = $express -> getExpressResult($orderList[0]);
    var_dump($result);
}