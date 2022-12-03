<?php

include './class/autoload.php';


$categoryList = category::listar();
//print_r($categoryList);
$productList = product::listar();
include './views/home.html';
