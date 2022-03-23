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

  //3)response
  $response = '[';
  for ($i=0; $i < count($articles_json); $i++) { 
    $response = $response.'{"id":"'.$articles_json[$i]['id'].'","Designation":"'.$articles_json[$i]['Designation'].'","Categorie":"'.$articles_json[$i]['Categorie'].'","PrixVente":"'.$articles_json[$i]['PrixVente'].'"}';
    if($i != count($articles_json)-1){
      $response = $response.",";
    }  
  }
  $response = $response.']';
  echo $response;
}
$con->close();
?>