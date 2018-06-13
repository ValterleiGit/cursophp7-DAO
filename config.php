<?php 
// Criando uma funcção de auto carregamento de class
 // função anonima

spl_autoload_register(function($clas_name){// uma class

 $filename ="class".DIRECTORY_SEPARATOR.$clas_name.".php"; //	DIRECTORY_SEPARATOR nos diz o caminho
  if (file_exists(($filename))) {
  	require_once($filename);
  }

});

 ?>