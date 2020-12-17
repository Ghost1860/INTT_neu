<?php
//Einfache version ohne Framework, berücksichtigt das die meißten Browser kein PUT und DELETE unterstützen


class produktauffüllung
{
   private $db;

   public function __construct()
   {
      //***TODO*** --> insert your database connection:
      $this->db = new mysqli("127.0.0.1","root","");

      if (mysqli_connect_errno())
      {
      	die("error while connection to database!:".mysqli_connect_error());
      }

      $this->db->select_db("intt_datenbank_lukaslinder");

      if($this->db->errno)
      {

      	die ($this->db->error);
      }
   }

   public function produktauffüllung($data)
   {
     //create insert string
     $stmt = "UPDATE inventory
     SET currentAmount = targetAmount
     WHERE inventoryID = '".$data['InventoryID']."'
     AND stationID = '".$data['StationID']."'
     AND productID = '".$data['ProductID']."';";


     $result = $this->db->query($stmt);

     $stmt = "UPDATE refill
     SET amount = 0
     WHERE stationID = '".$data['StationID']."'
      AND productID = '".$data['ProductID']."' ;";

      $result = $this->db->query($stmt);

     if($result == 1)
     {
       return "Die Produktauffüllung war erfolgreich!";
     }

     return "your statement: ".$stmt."<br /> received result:".$result;
   }
}
