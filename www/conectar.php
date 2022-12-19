<?php

  include("config.php"); 
//  $conexion=mysql_connect($Servidor,$Usuario,$Password) or die("Error: El servidor no puede conectar con la base de datos");
//  $descriptor=mysql_select_db($BaseDeDatos,$conexion);
  $descriptor=mysqli_connect($Servidor, $Usuario, $Password, $BaseDeDatos);
  if(mysqli_connect_error())
    echo "Connection Error.";
  else
    echo "Database Connection Successfully.";
  function mysqli_result($res, $row, $field=0) { 
    $res->data_seek($row); 
    $datarow = $res->fetch_array(); 
    return $datarow[$field]; 
  } 								

?>
