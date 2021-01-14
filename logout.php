<?php
    //delete all data in session
   unset($_SESSION['ID']);
   unset($_SESSION['Email']);
   unset($_SESSION['First_Name']);
   unset($_SESSION['Last_Name']);
   unset($_SESSION['Type']);
   
   //close the session after the logout
   session_destroy();

   header("Location: login.php"); 


?>