<?php

// include necessary classes
include('produktauffüllung.php');


$produktauffüllung= new produktauffüllung();
$data = array_merge($_GET, $_POST);
$method = $data['action'];
$retlnk = '<br> <a href="../index.html"> zur&uuml;ck zur Homeseite </a>';


 // create SQL based on HTTP method
switch ($method)
{


    case 'PUT':
      $sql = $produktauffüllung->produktauffüllung($data);
      echo $sql.$retlnk;
      break;

}



?>
