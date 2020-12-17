<?php
//Einfache version ohne Framework, berücksichtigt das die meißten Browser kein PUT und DELETE unterstützen


class sales
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

      $this->db->select_db("intt_datenbank_lukaslinder");

      if($this->db->errno)
      {

      	die ($this->db->error);
      }
   }


   // C reate

   public function addSales($data)
   {

/*     $zahl = amount;
      $inventoryAmount = "SELECT currentAmount FROM inventory WHERE stationID = '".$data['stationID']."' AND productID = '".$data['amount']."';";
      if(($inventoryAmount - $zahl) >= 0) {
*/
   	   $stmt = "INSERT INTO sales (
   	   stationID,
       productID,
       amount
     ) VALUES (                                 /*Was verkauft wurde*/
       '".$data['stationID']."',
       '".$data['productID']."',
   	   '".$data['amount']."'
   	   );";

   	   $result = $this->db->query($stmt);

       $stmt = "INSERT INTO refill (
       stationID,
       productID,
       amount

     ) VALUES (
       '".$data['stationID']."',
       '".$data['productID']."',    /* Muss auch wieder aufgefüllt werden */
       '".$data['amount']."'
       );";

       $result = $this->db->query($stmt);


       $stmt = "UPDATE inventory
       SET currentAmount = (currentAmount - '".$data['amount']."')
       WHERE stationID = '".$data['stationID']."'
       AND productID = '".$data['productID']."';";

      $result = $this->db->query($stmt);

   	   if($result == 1)
   	   {
   	   	 return "Sales wurde erfolgreich erfasst.";
   	   }
   	   return "your statment: ".$stmt."<br /> received result:".$result;}



}
