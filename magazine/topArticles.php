<html>
	<div id="topArticles">
		<h2>Trending Articles</h2>
		<?php
			$sql="SELECT * FROM articles,users where articles.AuthorID=users.id and articles.Approved=1 ORDER BY Rating DESC LIMIT 5";
			$result=mysql_query($sql) or die(mysql_error());
			while($row=mysql_fetch_array($result))
			{
				echo "<div class=\"topArticles-element\">";
					echo "<h4>"."<a href='article.php?id=".$row['ArticleID']."'>".$row['Title']."</a></h4>";
					echo "By "."<a href='profile.php?p=".$row['AuthorID']."'>".$row['name']."</a> Posted ".$row['Timestamp']."<br>";
					echo "<br>Rating : ".number_format($row['Rating'],2,'.',',')."/10  ( ".$row['NumRatings']." Ratings )";
	//				printArticleSummary($row);
				echo "</div>";
			}
		?>
	</div>
</html>
