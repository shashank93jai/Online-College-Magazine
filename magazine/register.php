<?php
include('connection.php');
$name=$_GET['name'];
$email=$_GET['email'];
$roll=$_GET['roll'];
$pass=$_GET['pass'];
$permissions=0; // normal user

$sql=mysql_query("SELECT * FROM users WHERE roll=".$roll);
if(mysql_num_rows($sql)==0)
{
    $sql1=mysql_query("INSERT INTO users(name,roll,email,permissions,password) VALUES (\"".$name."\",".$roll.",\"".$email."\",".$permissions.",\"".md5($pass)."\")");
    echo 'Registration Successful Login to continue';
}
else
{
    echo 'ROll no already exists';
}
?>