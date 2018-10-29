<?php
if (isset($_POST['call']))
{
    if ($_SESSION['usuario']=='Administrador'){
        $admin = true;
        echo $admin;   
    }
    else
    {
        $admin = false;
        echo $admin; 
    }
}

function check_admin(){   
    if ($_SESSION['usuario']=='Administrador')
    {
            $admin = true;
    }
    else
    {
            $admin = false;
    }
return $admin;    
}    
?>