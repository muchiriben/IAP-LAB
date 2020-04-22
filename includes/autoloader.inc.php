<?php
  
  spl_autoload_register('classAutoloader');

    function classAutoloader($classname){
        include 'classes/' . str_replace('\\', "/", $classname) . '.class.php';
      }

?>