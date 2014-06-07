<?php
session_start();
include('connection.php');
?>
<?php
$articleID=$_GET['articleID'];
$rating=$_GET['rating'];
$old=$_GET['old'];
if($rating<=10 && $rating>=1)
{
/*	$sql="SELECT rating from ratings where userID=".$_SESSION['id']." and articleID=".$articleID;
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);*/
	$newR=$rating-$old;
	$sql="UPDATE articles SET Rating=Rating+(".$newR."/NumRatings) where articleID=".$articleID ;
	$result=mysql_query($sql);
	$sql="UPDATE ratings SET rating=".$rating." WHERE userID=".$_SESSION['id']." AND articleID=".$articleID;
	$result=mysql_query($sql);
}
echo "New rating:  ";
?>
