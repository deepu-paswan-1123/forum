<?php

$servername="localhost";
$username="root";
$password="";
$database="idiscuss";

    $conn=mysqli_connect($servername,$username,$password,$database);
try{
    if(!$conn){
        throw new Exception("erroer occured:" .mysqli_connect_error($conn) );
    }
    else{
        echo "your database connection connect successfully";
        echo "<br>";
    }

}
catch(Exception $e){
    die("some error occured in the connection " . $e->getmessage());
}
?>