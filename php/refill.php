<?php
//Einfache version ohne Framework, berücksichtigt das die meißten Browser kein PUT und DELETE unterstützen


class refill
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


   public function getAllRefills()
   {

      $allRefills = array();
      $stmt = "SELECT stationID, productID, amount FROM refill WHERE amount > 0 GROUP BY  stationID, productID ;";
      $result = $this->db->query($stmt);

        if(empty($result))
        {
           return "your statement: ".$stmt."<br /> received result:".$result;
        }

      while ($row = $result->fetch_assoc())
      {
        $allRefills[] = $row;
      }

      return  $allRefills;
   }

}
