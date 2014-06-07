<?php
session_start();
?>
<?php
    if(isset($_SESSION['id']))
    {
        header("location:index.php");
    }
else
echo "
<html>
    <head>
        <script type='text/javascript' src='functions.js'>
        </script>
        <link rel='stylesheet' type='text/css' href='css/styles.css'/>
        <link rel='stylesheet' type='text/css' href='bootstrap/bootstrap/css/bootstrap.css'/>
    </head>
    <body>
        <table>
        <form method='get' action=''>
            <tr>
                <td>NAME:</td>
                <td><input type='text' id='reg_name' name='reg_name'/></td>
                <td><div id='name_error'></div></td>
            </tr>
            <tr><td>ROLLNO:</td>
                <td><input type='text' id='reg_roll' name='reg_roll'/></td>
 ";
                    if(isset($_GET['err']))
                        echo "<td div id='roll_error'>Roll no exists</div></td>";
                    else
                        echo "<td><div id='roll_error'></div></td>
            </tr>
            <tr>
                <td>EMAIL:</td>
                <td><input type='text' id= 'reg_email'  name='reg_email'/></td>
                <td><div id='email_error'></div></td>
            </tr>
            <tr>
                <td>PASSWORD:</td>
                <td><input type='password' id= 'reg_pass'  name='reg_pass'/></td>
                <td><div id='pass_error'></div></td>
            </tr>
            <tr>
                <td>REPEAT PASSWORD:</td>
                <td><input type='password' id= 'reg_rpass'  name='reg_rpass'/></td>
                <td><div id='rpass_error'></div></td>
            </tr>
            <tr>
                <td><input onclick='validate_register()' type='button' value='register'/></td>
            </tr>
            <tr>
                <td></td><td><div id='notification'></div></td>
            </tr>
        </form>
        </table>
    </body>
</html>
";