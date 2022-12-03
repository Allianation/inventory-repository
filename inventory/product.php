<?php

include './class/autoload.php';

if(isset($_POST['submit']) && $_POST['submit'] == 'save') {
    $product = new product();
    $product->name_product = $_POST['name_product'];
    
    //Move the uploaded image into the folder: extras/uploads
    $filename = $_FILES["image_product"]["name"];
    $tempname = $_FILES["image_product"]["tmp_name"];
    $folder = "./extras/uploads/" . $filename;
    
    if (move_uploaded_file($tempname, $folder)) {
        echo "<script>alert('Image uploaded successfully!')</script>";
    } else {
        echo "<script>alert('Failed to upload image!')</script>";
    }
    
    $product->image_product = $folder;
    $product->description_product = $_POST['description_product'];
    $product->id_category = $_POST['id_category'];
    $product->guardar();
    echo "<script>alert('Save Product Successfully')</script>";
} else if(isset($_GET['add'])) {
    include 'views/product.html';
    die();
}

$categoryList = category::listar();
$productList = product::listar();
include 'views/home.html';

