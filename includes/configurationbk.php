<?php
  session_start();
  include "variables.php";
  include "db.php";
  include "function.php";
  include "customconfig.php";

  //***************************** Standard Function Declarations *******************************//
  extract($_POST);
  extract($_GET);
  //********************************************************************************************//

  //***************************** Project Paths ************************************************//
  define("SITEURL", "https://". $_SERVER['SERVER_NAME']); // Website URL
  define("DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]);
  define("ADMINURL", SITEURL . "/admin/"); // Path of admin directory
  define("VENDORURL", SITEURL . "/vendors/"); // Path of seller directory
    define("SUPPORTURL", SITEURL . "/support/"); // Path of admin directory    
  //********************************************************************************************//

  define('CPHOST', 'arcindustries.co.in');
  define('CPUSER', 'myarc');
  define('CPPWD', 'mTX)Jm4N&Kly');
  define("BUZZADAPTER","26c1cb94e5dfd3ac874b9eedfb08fb1ddccee300c4993c553cd73dda4404f8c6"); 

  //***************************** Document Paths ************************************************//
  define('DOCUMENTURL', "https://www.surun.in/documentation/help/");
  //********************************************************************************************//