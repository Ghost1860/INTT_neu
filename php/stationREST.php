<?php

// include necessary classes
include('station.php');


$station = new station();
$data = array_merge($_GET, $_POST);
$method = $data['action'];
$retlnk = '<br> <a href="../index.html"> zur&uuml;ck zur Homeseite </a>';


 // create SQL based on HTTP method
switch ($method)
{
  case 'GET':
  $sql = $station->getAllStations();
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($sql);
    break;

  case 'POST':
    $sql = $station->addStation($data);
    echo "Antwort: ".$sql.$retlnk;
    break;

}

?>
