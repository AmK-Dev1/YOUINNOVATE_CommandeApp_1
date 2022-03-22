<?php

require 'connection.php';
header('Access-Control-Allow-Origin: *');


// Collect Data
if( 
    isset($_POST['article']) && 
    isset($_POST['qte']) && 
    isset($_POST['tablenum'])
  )
  {
        $article = $_POST['article'];
        $qte = $_POST['qte'];
        $tablenum = $_POST['tablenum'];
        

        // 1) SQL Querry wcommande 
        $query_1 = "INSERT INTO wcommande (article , qnt, TableNum) VALUES ('$article', '$qte', '$tablenum')";
        $query_2 = "INSERT INTO checktbl (TableNum,serveur) VALUES ('$tablenum', '$tablenum')";
    
        if(mysqli_query($con , $query_1)){
    
                //Done, Now we need to Insert data into chacktbl
                if(mysqli_query($con, $query_2)){
                    //Done
                    http_response_code(201);
                }else{
                    echo"The Seconde Query failed";
                }
        }else{
            echo "The first Query failed";
        }


  }else{
      die("No data");
  }
?>