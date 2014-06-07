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
	$newR=$rating-$old;
	$sql="UPDATE articles SET Rating=Rating+(".$newR."/(NumRatings+1)),NumRatings=NumRatings+1 where articleID=".$articleID ;
	$result=mysql_query($sql);
	$sql="INSERT INTO ratings values(".$_SESSION['id'].",".$articleID.",".$rating.")";
	$result=mysql_query($sql);
}
echo "Your Rating:  ";
?>
