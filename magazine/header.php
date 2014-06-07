<link rel='stylesheet' type="text/css" href='css/styles.css'/>
<link rel='stylesheet' type='text/css' href='bootstrap/bootstrap/css/bootstrap.css'/>
<?php
    if(!isset($_SESSION['name']))
    {

        echo "
            <div id='header_bar'>
            <a href='loginform.php'>LOGIN</a>
            <a href='registerform.php'>REGISTER HERE</a>
            </div>
            ";
    }
    else
    {
        echo"
            <div id='header_bar'>
            <a href='profile.php?p=".$_SESSION['id']."'>".$_SESSION['name']."</a>
            <a href='logout.php'>LOGOUT</a>
            </div>
        ";
    }
?>
