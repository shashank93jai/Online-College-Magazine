<?php
include('connection.php');
$name=$_POST['name'];
$email=$_POST['email'];
$roll=$_POST['roll'];
$pass=$_POST['pass'];
$rsec=$_POST['rsec'];
$rans=$_POST['rans'];
$permissions=0; // normal user

$sql=mysql_query("SELECT * FROM users WHERE roll=".$roll);
if(mysql_num_rows($sql)==0)
{
    $sql1=mysql_query("INSERT INTO users(name,roll,email,permissions,password,question,answer) VALUES (\"".$name."\",".$roll.",\"".$email."\",".$permissions.",\"".md5($pass)."\",\"".$rsec."\",\"".$rans."\")");
    echo 'Registration Successful Login to continue';
}
else
{
    echo 'Roll no already exists';
}
?>
<?php
	mysql_close($con);
?>
