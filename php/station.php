<?php
//Einfache version ohne Framework, berücksichtigt das die meißten Browser kein PUT und DELETE unterstützen


class station
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

   public function addStation($data)
   {
   	   //create insert string
   	   $stmt = "INSERT INTO station (
   	   coordsA,
   	   coordsL,
       location,
       type,
   	   description
   	   ) VALUES (
   	   '".$data['coordsA']."',
   	   '".$data['coordsL']."',
       '".$data['location']."',
       '".$data['type']."',
   	   '".$data['description']."'
   	   );";

       //commit db request
   	   $result = $this->db->query($stmt);

   	   if($result == 1)
   	   {
   	   	 return "station succesfully inserted.";
   	   }

   	   return "your statment: ".$stmt."<br /> received result:".$result;
   }


  // R ead

   public function getAllStations()
   {
      $allStations = array();
      $stmt = "SELECT * FROM station;";
      $result = $this->db->query($stmt);

        if(empty($result))
        {
           return "your statement: ".$stmt."<br /> received result:".$result;
        }

      while ($row = $result->fetch_assoc())
      {
        $allStations[] = $row;
      }

      return  $allStations;
   }




}
