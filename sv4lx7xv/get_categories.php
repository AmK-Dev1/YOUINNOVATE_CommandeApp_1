<?php 
require "connection.php";
header('Access-Control-Allow-Origin: *');

//check connection 
if(!$con){
    die("Connection failed :" . mysqli_connect_errno());
}

// Method 
$method = $_SERVER['REQUEST_METHOD'];
if($method =='GET'){
    // 1) Query to stock to get categories
    $query = "SELECT DISTINCT Categorie FROM stock";
    $categories = mysqli_query($con,$query);
    // 2) TO json type
    $categories_json = array();
    while($row = mysqli_fetch_assoc($categories)){
        array_push($categories_json , $row["Categorie"]);
    }

    $response ='[';
    for ($i=0; $i < count($categories_json); $i++) { 
        $response = $response.'"'.$categories_json[$i].'"'.',';
    };
    $response = substr_replace($response, "", -1).']';
    echo $response; 
    
}
$con->close();
?>