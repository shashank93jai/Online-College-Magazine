<?php
/*session_start();
if(isset($_SESSION['name']))
    echo $_SESSION['name'];
else
{

    echo "<div id='registerdiv' style='margin-left:100px;margin-top:100px'>";
    include('registerform.php');
    echo "</div>";
    echo "<div id='logindiv' style='margin-left:700px;margin-top:-150px'>";
    include('loginform.php');
    echo "</div>";
}*/
?>
<?php
	session_start();
?>
<?php
include('connection.php');
function logged_in()
{
	if(isset($_SESSION['name']))
		return True;
	return False;
}
function getTopArticles()
{
	$sql="SELECT Title,Description,name,Timestamp FROM articles,users where articles.AuthorID=users.id";
	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result))
	{
		echo '<br />';
		echo '<div class='.'article'.'>';
		echo $row['Title'].'<br />'.$row['Description'].'<br />by '. $row['name'].'<br />'. $row['Timestamp'].'<br />';
		echo '</div>';
	}
}
$logged=logged_in();
if($logged)
{
	$username=$_SESSION['name'];
	echo '<br />hi '.$username;
	echo '<br />';
}
else
{
	echo '<a href="loginform.php">Login</a><br />
	<a href="registerform.php">Register</a><br />';
	$username="guest";
}
getTopArticles();
if($logged)echo '<a href="createArticle.php">Create article</a>';
else echo '<a href="loginform.php">Create article</a>';
?>
<html>
	<body>
		<a href='logout.php'>logout</a>
	</body>
</html>
