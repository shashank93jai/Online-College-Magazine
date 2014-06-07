<link rel='stylesheet' type='text/css' href='bootstrap/bootstrap/css/bootstrap.css'/>
<link rel='stylesheet' type="text/css" href='css/styles.css'/>
<?php
session_start();

include('connection.php');
include('functions.php');
include('header.php');
include('menu.php');
include('searchform.php');
include('topArticles.php');
function getTopArticles($page)
{
    $sql="SELECT * FROM articles,users where articles.AuthorID=users.id AND users.id=".$_GET['p'];
    $result=mysql_query($sql);
    $count=0;
    if(mysql_num_rows($result))
    {

        $row=mysql_result($result,($page-1)*3);
        $sql="SELECT * FROM articles,users where articles.AuthorID=users.id AND users.id=".$_GET['p']." and articles.articleID>=$row limit 3";
        $result=mysql_query($sql) or die(mysql_error());
        if(mysql_num_rows($result)!=0)
        {
            while($row=mysql_fetch_array($result))
            {
                if(!isset($_SESSION['id']) || $_SESSION['id']!=$_GET['p'])
                {
                    if($row['Approved']==1)
                    {
                        printArticle($row,1);
                        $count++;
                    }

                }
                else if($_SESSION['id']==$_GET['p'])
                {
                    printArticle($row,0);
                }
            }
        }
    }
    else
        echo "<br>You have not published any articles yet! <a href='createArticleForm.php'>Create one here</a>";

    getPages($page);
}
function getPages($id)
{
    $sql="SELECT * FROM articles,users where articles.AuthorID=users.id AND users.id=".$_GET['p'];
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

    echo "<li><a href='profile.php?p=".$_GET['p']."&page=".$prev."'>Prev</a></li>";
    echo "<li><a href='profile.php?p=".$_GET['p']."&page=".$next."'>Next</a></li>";
    echo "</ul>
    </div>";
}
if(isset($_GET['page']))
{
    echo "<div id='content'>";
    getTopArticles($_GET['page']);
    echo "</div>";
}

else
{
    echo "<div id='content'>";
    getTopArticles(1);
    echo "</div>";
}
?>