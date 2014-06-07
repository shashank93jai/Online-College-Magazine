<script type="text/javascript" src="functions.js"></script>
<?php
function logged_in()
{
	if(isset($_SESSION['name']))
		return True;
	return False;
}
function printArticle($row,$num)
{
	global $logged;
    $categories=explode(" ",$row['Categories']);
	echo '<br />';
	echo '<div class='.'article'.'>';
	echo "<h2>"."<a href='article.php?id=".$row['ArticleID']."'>".$row['Title']."</a></h2>";
    if($num==0)
    {
        if($row['Approved']==1)echo '(Approved)<br>';
        else if($row['Approved']==0)echo '(Pending)<br>';
        else if($row['Approved']==2)echo '(This article has been disapproved)<br>';
    }
	echo "By "."<a href='profile.php?p=".$row['AuthorID']."'>".$row['name']."</a> Posted ".$row['Timestamp']."<br>";
    foreach($categories as $category)
    {
        echo "<a href='category.php?cat=".$category."'>".$category."</a> ";
    }
    echo "<br>Rating : ".number_format($row['Rating'],2,'.',',')."/10  (".$row['NumRatings']." Ratings)<br><br>";
	echo "<div class='article-content' style=''>".nl2br($row['Description'])."</div>";
	if($logged)
	{
		$sql="SELECT rating from ratings where userID=".$_SESSION['id']." and articleID=".$row['ArticleID'];
		$result=mysql_query($sql);
		if(mysql_num_rows($result)==0)
		{
			$sel=5;
			$new=1;
            $old=$row['Rating'];
			echo "<div id=\"checkRated".$row['ArticleID']."\">Your Rating(currently not rated):  </div>";
		}
		else
		{
			$r=mysql_fetch_array($result);
			$sel=$r['rating'];
			$new=0;
            $old=$sel;
			echo "<div id=\"checkRated".$row['ArticleID']."\">Your Rating:  </div>";
		}
		echo "<select id=\"rating".$row['ArticleID']."\">";
		for($i=1;$i<=10;$i=$i+1)
		{
			echo "<option ".($sel == $i ? ' selected="selected"' : '').">".$i."</option>";
		}
		echo	"</select>";
        echo "<button class='btn btn-small btn-primary' id=\"button".$row['ArticleID']."\" onclick=\"changeRating(".$row['ArticleID'].",".$new.",".$old.")\">Change</button>";
//		echo "<div id=\"response".$row['ArticleID']."\"></div>";
	}
	echo '</div>';
}
function printArticleSummary($row)
{
    global $logged;
    $categories=explode(" ",$row['Categories']);
    echo '<br />';
    echo '<div class='.'article'.'>';
    echo "<h2>"."<a href='article.php?id=".$row['ArticleID']."'>".$row['Title']."</a></h2>";
    echo "By "."<a href='profile.php?p=".$row['AuthorID']."'>".$row['name']."</a> Posted ".$row['Timestamp']."<br>";
    foreach($categories as $category)
    {
        echo "<a href='category.php?cat=".$category."'>".$category."</a> ";
    }
    echo "<br>Rating : ".number_format($row['Rating'],2,'.',',')."/10  (".$row['NumRatings']." Ratings)<br><br>";
    echo "<div class='article-content' style=''>".nl2br(substr($row['Description'],0,500))."...<br><br>";
    echo "Read more <a href='article.php?id=".$row['ArticleID']."'>Here</a></div>";
    if($logged)
    {
        $sql="SELECT rating from ratings where userID=".$_SESSION['id']." and articleID=".$row['ArticleID'];
        $result=mysql_query($sql);
        if(mysql_num_rows($result)==0)
        {
            $sel=5;
            $new=1;
            $old=$row['Rating'];
            echo "<div id=\"checkRated".$row['ArticleID']."\">Your Rating(currently not rated):  </div>";
        }
        else
        {
            $r=mysql_fetch_array($result);
            $sel=$r['rating'];
            $new=0;
            $old=$sel;
            echo "<div id=\"checkRated".$row['ArticleID']."\">Your Rating:  </div>";
        }
        echo "<select id=\"rating".$row['ArticleID']."\">";
        for($i=1;$i<=10;$i=$i+1)
        {
            echo "<option ".($sel == $i ? ' selected="selected"' : '').">".$i."</option>";
        }
        echo	"</select>";
        echo "<button class='btn btn-small btn-primary' id=\"button".$row['ArticleID']."\" onclick=\"changeRating(".$row['ArticleID'].",".$new.",".$old.")\">Change</button>";
//		echo "<div id=\"response".$row['ArticleID']."\"></div>";
    }
    echo '</div>';

}
function printComment($row)
{
	echo '<br />';
	echo '<div class='.'comment'.'>';
	if($row['AuthorID']!=-1)echo "By "."<a href='profile.php?p=".$row['AuthorID']."'>".$row['name']."</a><br>";
	else echo "By Anonymous<br>";
	echo "<div style='word-wrap:break-word;width:600px;'>".nl2br($row['Comment'])."</div>";
	echo "Posted on ".$row['Timestamp']."<br><br>";
	if(isset($_SESSION['id']))
	{
		if($row['AuthorID']==$_SESSION['id'])echo "<a href='editComment.php?CommentID=".$row['CommentID']."'>edit</a>";
	}
	echo '</div>';
}
function validComment($c)
{
	return True;
}

?>
