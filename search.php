<?php 
session_start();
include('connection.php');
include('functions.php');
include('header.php');
include('menu.php');
?>
<html>
	<head>
		<script type="text/javascript" src="functions.js"></script>
	</head>
	<body>

		<form method="GET" action="#">
			<input type="text" name="searchQ" id="searchQ" value=<?php if(isset($_GET['seearchQ']))echo mysql_real_escape_string($_GET['searchQ']) ?> >
			<input type="submit" name="submit" id="submit" class="btn btn-small btn-primary"/>
		</form>
		<div id='searchResults'>
			<?php
				function filterWords($q)
				{
					//return array of words
					$x=preg_split("/[\s,]+/",$q);
					return $x;
				}
				function calcRank($keyw,$query)
				{
					$i=array_intersect($keyw,$query);
					$ans=(100*count($i)/(count($keyw)+0.0));
					return $ans;
				}
				function my_sort($a,$b)
				{
					if($a['rank']==$b['rank'])return 0;
					return ($a['rank']<$b['rank'])?1:-1;
				}
				if(isset($_GET['searchQ']))
				{
					$sql="SELECT * FROM articles,users where users.id=articles.AuthorID and articles.Approved=1";
					$result=mysql_query($sql);
					$i=0;
					$articles=array();
					$query=filterWords(mysql_real_escape_string(strtolower($_GET['searchQ'])));
					while($row=mysql_fetch_assoc($result))
					{
						$articles[$i]=$row;
						$keywords=strtolower($row['Keywords']);
						$keywords=filterWords($keywords);
						$articles[$i]['rank']=calcRank($keywords,$query);
						$i=$i+1;
					}

                    usort($articles,"my_sort");
                    foreach($articles as $article)
                    {
                        if($article['rank']==0)break;
                        //printArticle($article);
                        if(!isset($_SESSION['id']) || $_SESSION['id']!=$article['AuthorID'])
                        {
                            if($article['Approved']==1)
                            {
                                printArticle(($article),1);
                            }
                            else
                            {
                                //echo "The article you are trying to find cannot be accessed";
                            }
                        }
                        else if($_SESSION['id']==$article['AuthorID'])
                        {
                            printArticle(($article),0);
                        }
                        echo "<br /><br />";
                    }
				}
			?>
			
		</div>
	</body>
</html>
