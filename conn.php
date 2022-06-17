<?php
$user='root';
$psw='';
$db_name="sqlinjectionproject";
$host_name='localhost';
$con =mysqli_connect($host_name,$user,$psw,$db_name);


if(!$con){
    die("failed conn".mysqli_connect_error());
}
   

?>