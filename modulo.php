<?php
$modulo=$_GET["codigo"];
setcookie("modulo", $modulo,time()+3600*24*30, '/');
header("location:index.php?opcion=pageStart");

?>