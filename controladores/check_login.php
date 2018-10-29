<?php
function check_login()
{
    if (isset($_SESSION['logueado'])) {
          return true;
    }
    else
    {
        session_destroy();
        return false;
    }
} 
?>