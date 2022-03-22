<?php 
require "connection.php";
header('Access-Control-Allow-Origin: *');

if(!$con){
  die("Connection failed :" . mysqli_connect_error());
}
//chekck method
$method = $_SERVER['REQUEST_METHOD'];

if($method == "POST" && isset($_POST['article'])){

  //get data
  $article = $_POST['article'];
  // 1) SQL Querry to stock to get articles
  $query = "SELECT  actif   FROM stock WHERE Designation = '".$article."'";
  
  if(mysqli_query($con , $query)){
      $res = mysqli_fetch_all(mysqli_query($con , $query));
      if(count($res) > 0){
        echo $res[0][0];
      }
      else{
          echo "0";
      }
      
  }else{
      echo "Eroor";
  }

}

$con->close();
?>