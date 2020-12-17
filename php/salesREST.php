<?php

// include necessary classes
include('sales.php');


$sales = new sales();
$data = array_merge($_GET, $_POST);
$method = $data['action'];
$retlnk = '<br> <a href="../index.html"> zur&uuml;ck zur Homeseite </a>';


 // create SQL based on HTTP method
switch ($method)
{
  case 'GET':



    	$sql = $station->getAllSales();
        header('Content-type: ../application/json; charset=utf-8');
        echo json_encode($sql);
        break;

    break;

  case 'POST':
    $sql = $sales->addSales($data);
    echo "Antwort: ".$sql.$retlnk;
    break;

}

?>
