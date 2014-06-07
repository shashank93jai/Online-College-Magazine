<?php
include('connection.php');
include('functions.php');
include('header.php');
include('menu.php');
?>
<?php
if(isset($_GET['mode']) && $_GET['mode']==1)
{
	$id=$_POST['id'];
	$sql=mysql_query("SELECT * FROM users WHERE roll=".$id);
	if(mysql_num_rows($sql)==0)
	{
		header('location:forgotpassword.php?err=1');
	}
	else
	{
		$row=mysql_fetch_array($sql);
		$q=$row['question'];
		$ans=$row['answer'];
		
		echo $q."<br>
		<form action='forgotpassword.php' method='post'>
			ANSWER:<input type='text' name='secret'/><br>
			NEW PASSWORD:<input type='password' name='password'/>
			<input type='hidden' name='roll' value='".$row['roll']."'/>
			<input type='submit' class='btn btn-mini btn-primary'/>
		</form>
		";
	}
}
else if(isset($_POST['secret']))
{
	$roll=$_POST['roll'];
	$secret=$_POST['secret'];
	$pass=md5($_POST['password']);
	$sql="SELECT * FROM users WHERE roll=".$roll." AND answer=\"".$secret."\"";
	$result=mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($result)==1)
	{
			
			$sql="UPDATE users SET password=\"".$pass."\" WHERE roll=".$roll;
			$result=mysql_query($sql);
			echo 'Password Changed Successfully';
	}
	else
	{
		header('location:forgotpassword.php?err=2');
	}
}
else
echo
"
<form action='forgotpassword.php?mode=1' method='post'>
	ENTER ID:<input type='text' name='id'/><br>
	<input type='submit' class='btn btn-mini btn-primary'/>
</form>
";
if(isset($_GET['err']) && $_GET['err']==1)
{
	echo "<p style='color:red'>Roll number does not exist</p>";
}

if(isset($_GET['err']) && $_GET['err']==2)
{
	echo "<p style='color:red'>Wrong answer</p>";
}
?>
