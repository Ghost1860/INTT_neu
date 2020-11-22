<?php
//Einfache version ohne Framework, berücksichtigt das die meißten Browser kein PUT und DELETE unterstützen


class product
{
   private $db;

   public function __construct()
   {
      //***TODO*** --> insert your database connection:
      $this->db = new mysqli("localhost","root","");

      if (mysqli_connect_errno())
      {
      	die("error while connection to database!:".mysqli_connect_error());
      }

      $this->db->select_db("prototyp");

      if($this->db->errno)
      {

      	die ($this->db->error);
      }
   }


   // C reate

   public function addProduct($data)
   {
   	   //create insert string
   	   $stmt = "INSERT INTO product (
   	   name,
   	   description,
       price,
       durability,
   	   ) VALUES (
   	   '".$data['name']."',
   	   '".$data['description']."',
       '".$data['price']."',
   	   '".$data['durability']."'
   	   );";

       //commit db request
   	   $result = $this->db->query($stmt);

   	   if($result == 1)
   	   {
   	   	 return "Product succesfully inserted.";
   	   }

   	   return "your statment: ".$stmt."<br /> received result:".$result;
   }


  // R ead

   public function getAllProducts()
   {
      $allProducts = array();
      $stmt = "SELECT * FROM product;";
      $result = $this->db->query($stmt);

        if(empty($result))
        {
           return "your statement: ".$stmt."<br /> received result:".$result;
        }

      while ($row = $result->fetch_assoc())
      {
        $allProducts[] = $row;
      }

      return  $allProducts;
   }

   public function getCoordinates($stationID)
   {
   	  $allStations = array();
   	  $stmt = "SELECT * FROM station WHERE stationID = ".$stationID.";";
   	  $result = $this->db->query($stmt);

        if(empty($result))
        {
           return "your statement: ".$stmt."<br /> received result:".$result;
        }

      while ($row = $result->fetch_assoc())
      {
        $allStations[] = $row;
      }

      return $allStations;
   	  //return $row = $result->fetch_assoc();
   }


   public function findByLocation($location)
   {
   	  $allStations = array();
   	  $stmt = "SELECT * FROM station WHERE location = '".$location."';";
      $result = $this->db->query($stmt);

        if(empty($result))
        {
           return "your statement: ".$stmt."<br /> received result:".$result;
        }

      while ($row = $result->fetch_assoc())
      {
        $allStations[] = $row;
      }

      return $allStations;
   }



// U pdate

  public function updateStation($data)
  {
    //create insert string
    $stmt = "UPDATE station SET coordsA = '".$data['coordsA']."',
                                coordsL = '".$data['coordsL']."',
                               location = '".$data['location']."',
                                   type = '".$data['type']."',
                            description =  '".$data['description']."'
                            WHERE stationID = ".$data['stationID']." ;";

    //commit db request
    $result = $this->db->query($stmt);

    if($result == 1)
    {
      return "OK";
    }

    return "your statement: ".$stmt."<br /> received result:".$result;
  }


// D elete

   public function removeStation($stationID)
   {
      $allSupplies = array();
      $stmt = "DELETE FROM station WHERE stationID = ".$stationID.";";
      $result = $this->db->query($stmt);

       if($result == 1)
       {
         return "station succesfully deleted.";
       }

       return "your statment: ".$stmt."<br /> received result:".$result;
   }
}
