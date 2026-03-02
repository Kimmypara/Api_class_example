<?php
// this file sets up the core API structure

//define named constants
//DS = / or \ depending on the server OS/Config
//SITE_ROOT = root directory of project
    //i.e. C:/xampp/htdocs/API_class_example
defined('DS') ? null : define('DS', DIRECTORY_SEPERATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'xamp'.DS.'htdocs'.DS.'API_class_example');

require_once("config.php");


?>