<html>
<head>
    <script type='text/javascript' src='functions.js'>
    </script>
    <link rel='stylesheet' type='text/css' href='css/styles.css'/>
    <link rel='stylesheet' type='text/css' href='bootstrap/bootstrap/css/bootstrap.css'/>
</head>
<body>
    <?php 
    
include('connection.php');
include('functions.php');
include('header.php');
include('menu.php');
    ?>

    <table id='login_table'>
        <form method='post' action=''>
            <tr>
                <td><h3>LOGIN HERE</h3></td><td></td>
            </tr>
            <tr>
                <td>Roll No:</td>
                <td><input type='text' id='login_roll' name='login_roll'/></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type='password' id='login_pass' name='login_pass'/></td>
            </tr>
            <tr>
                <td><input type='button' value='Login' onclick='validate_login()' class="btn btn-small btn-primary"/></td>
            </tr>
            <tr>
                <td></td><td><div id='login_err'></div></td>
            </tr>
        </form>
    </table>
    <a href='forgotpassword.php'><u>Forgot Password?</u></a>
</body>
