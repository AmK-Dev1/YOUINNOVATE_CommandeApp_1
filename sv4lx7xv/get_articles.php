<?php 
require "connection.php";
header('Access-Control-Allow-Origin: *');

if(!$con){
  die("Connection failed :" . mysqli_connect_error());
}
//chekck method
$method = $_SERVER['REQUEST_METHOD'];

if($method == "GET"){
  // 1) SQL Querry to stock to get articles
  $query = "SELECT  id , Designation , Categorie , PrixVente  FROM stock WHERE actif=1 ";
  $articles = mysqli_query($con , $query);

  // 2) To json type 
  $articles_json = array();
  while($row = mysqli_fetch_assoc($articles)){
    array_push($articles_json , $row);
  }
  // 3) Response :
  $response = json_encode($articles_json);
  echo $response;
}
$con->close();
?>