<?php
//Einfache version ohne Framework, berücksichtigt das die meißten Browser kein PUT und DELETE unterstützen


class product
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

   public function addProduct($data)
   {
   	   $stmt = "INSERT INTO products (
   	   name,
       price,
       durability
   	   ) VALUES (
   	   '".$data['name']."',
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

   public function getAllProducts()
   {
      $allProducts = array();
      $stmt = "SELECT * FROM products;";
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

}
