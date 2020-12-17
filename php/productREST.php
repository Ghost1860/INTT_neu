<?php

// include necessary classes
include('product.php');


$product = new product();
$data = array_merge($_GET, $_POST);
$method = $data['action'];
$retlnk = '<br> <a href="../index.html"> zur&uuml;ck zur Homeseite </a>';


 // create SQL based on HTTP method
switch ($method)
{
  case 'GET':

    	$sql = $product->getAllProducts();
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($sql);


    break;


  case 'POST':
    $sql = $product->addProduct($data);
    echo "Antwort: ".$sql.$retlnk;
    break;



}



?>
