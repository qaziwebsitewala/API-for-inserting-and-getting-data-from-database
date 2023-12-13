<?php
 define("host", "localhost");
 define("username", "root");
 define("pass", "");
 define("dbname", "webapp");
  
  $conn = mysqli_connect(host, username, pass, dbname);
  if (!$conn) {
   die('Could not connect !<br />Please contact the site\'s administrator.');
   };
?>


