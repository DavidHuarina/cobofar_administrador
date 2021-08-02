<?php 
//header('Content-Type: text/html; charset=iso-8859-1');
  require_once 'functions.php';
  //require_once 'functionsGeneral.php';
	include("head.php");
  include("librerias.php");// se debe cambiar a la parte posterior
?>    
    <div id="pcoded" class="pcoded">
      <div class="pcoded-overlay-box"></div>
      <div class="pcoded-container navbar-wrapper">          
                <?php
                if(!isset($_GET['opcion'])){
                   include("cabecera.php");
                   ?><div class="pcoded-main-container">
                      <div class="pcoded-wrapper"><?php
                          include("home.php");
                      ?></div>
                      </div><?php
                 }else{
                     include("cabecera.php");
                     ?><div class="pcoded-main-container">
                      <div class="pcoded-wrapper"><?php
                     include("menu.php"); 
                     require_once('routing.php');
                     ?></div>
                      </div><?php          
                 } 
                ?>                
      </div>
    </div>
