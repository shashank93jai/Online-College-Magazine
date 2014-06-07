<link rel='stylesheet' type="text/css" href='css/styles.css'/>
<link rel='stylesheet' type='text/css' href='bootstrap/bootstrap/css/bootstrap.css'/>
<?php
	session_start();
?>
<?php
include('connection.php');
include('functions.php');
include('header.php');
include('menu.php');
include('searchform.php');
include('topArticles.php');
$logged=logged_in();
function getTopArticles($page)
{
	$sql="SELECT * FROM articles,users where articles.AuthorID=users.id and articles.Approved=1 ORDER BY Timestamp DESC";
	$result=mysql_query($sql) or die(mysql_error());

	$i=1;
	while($i<=($page*3) && $row=mysql_fetch_array($result))
	{
	    if($i>(($page-1)*3))printArticleSummary($row);
	    $i=$i+1;
	}
	getPages($page);
}
function getPages($id)
{
    $sql="SELECT * FROM articles,users where articles.AuthorID=users.id and articles.Approved=1";
    $result=mysql_query($sql);
    $num=mysql_num_rows($result);

    echo "<div class='pagination pagination-small'>
      <ul>";

        if($id==1)$prev=1;
        else $prev=$id-1;

        if($num%3==0)$i=(int)$num/3;
        else $i=(int)($num/3)+1;

        if($id==$i)$next=$id;
        else $next=$id+1;

        echo "<li><a href='index.php?p=".$prev."'>Prev</a></li>";
        echo "<li><a href='index.php?p=".$next."'>Next</a></li>";
      echo "</ul>
    </div>";
}
if(isset($_GET['p']))
{
    echo "<div id='content'>";
    getTopArticles($_GET['p']);
    echo "</div>";
}
else
{
    echo "<div id='content'>";
    getTopArticles(1);
    echo "</div>";
}
?>
<?php
	mysql_close($con);
?>
