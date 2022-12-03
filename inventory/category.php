<?php

include './class/autoload.php';

if(isset($_POST['submit']) && $_POST['submit'] == 'save') {
    $category = new category();
    $category->name_category = $_POST['category_name'];
    $category->guardar();
    echo "<script>alert('Save Category Successfully')</script>";
} else if(isset($_GET['add'])) {
    include 'views/category.html';
    die();
}

$categoryList = category::listar();
$productList = product::listar();
include 'views/home.html';