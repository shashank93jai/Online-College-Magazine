<form method="POST" action="addComment.php">
	<input type='hidden' name='userID' id='userID' value=<?php echo $userID ?> >
	<input type='hidden' name='articleID' id='articleID' value=<?php echo $_GET['id'] ?> >
	<textarea rows='5' cols='60' name='comment' id='comment'></textarea>
    <input type="submit" value="Add Comment" />
</form>
