<?php
$logged=logged_in();
echo "<div class=\"navbar\">";
	echo "<div class=\"navbar-inner\">";
	echo "<ul class=\"nav\">";
	echo '<li><a href="index.php">Home</a></li>';
	if($logged)echo '<li><a href="createArticleForm.php">Create article</a></li>';
	else echo '<li><a href="loginform.php">Create article</a></li>';
//	echo "<br>";
	if($logged)echo "<li><a href='profile.php?p=".$_SESSION["id"]."'>View my articles</a></li>";
	else echo '<li><a href="loginform.php">View my articles</a></li>';
	if($logged)echo "<li><a href='edit.php'>Edit my articles</a></li>";
	else echo '<li><a href="loginform.php">Edit my articles</a></li>';
	if(isset($_SESSION['permissions']))
	{
		if($_SESSION['permissions']==1)
			echo "<li><a href='edit.php?mode=admin'>Admin</a></li>";
		if($_SESSION['permissions']==1 || $_SESSION['permissions']==2)
		{
			echo "<li><a href='edit.php?mode=mod'>Moderate</a></li>";
		}
	}
	echo "</ul>";
	echo "</div>";
	echo "</div>";
?>
