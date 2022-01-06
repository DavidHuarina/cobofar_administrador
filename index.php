<?php
  //carga la plantilla con la header y el footer
require("conexioncomercial.inc");
if(isset($_COOKIE['global_usuario'])){
  require('layouts/layout.php'); 

}else{
  header("location:login.html"); 
}