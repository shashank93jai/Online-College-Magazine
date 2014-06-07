<?php
session_start();
if(!isset($_SESSION['id']))header('Location: index.php');
if(!isset($_GET['CommentID']) && !isset($_POST['CommentID']))header('Location: index.php');
include('connection.php');
include('header.php');
include('functions.php');	
if(!isset($_POST['Comment']))
{
	$sql="SELECT * FROM comments WHERE CommentID=".$_GET['CommentID'];
	$result=mysql_query($sql);
	if(mysql_num_rows($result)==1)
	{
		$row=mysql_fetch_array($result);
	}
	else header('Location: index.php');
	if($row['AuthorID']!=$_SESSION['id'])header('Location: index.php');
}
else
{
	$sql="UPDATE comments SET Comment=\"".$_POST['Comment']."\" WHERE CommentID=".$_POST['CommentID'];
	$result=mysql_query($sql);
	header('Location: index.php');
}
?>
<html>
	<body>
		<form method="POST" action="editComment.php">
			<input type='hidden' name='CommentID' id='CommentID' value=<?php echo htmlentities($_GET['CommentID']); ?> >
			Comment: <textarea rows='5' cols='60' name='Comment' id='Comment'><?php echo htmlentities($row['Comment']); ?> </textarea>
			<br />
			<input type="submit" value="Edit" />
		</form>
	</body>
</html>
