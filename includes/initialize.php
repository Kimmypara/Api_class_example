<?php
// this file sets up the core API structure

//define named constants
//DS = / or \ depending on the server OS/Config
//SITE_ROOT = root directory of project
    //i.e. C:/xampp/htdocs/API_class_example
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'xampp'.DS.'htdocs'.DS.'API_class_example');

defined("CORE_PATH") ? null : define("CORE_PATH", SITE_ROOT.DS."core".DS); 

require_once("config.php");

require_once(CORE_PATH."user.php");
require_once(CORE_PATH."post.php");

?>