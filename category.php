<?php
session_start();
include('connection.php');
include('functions.php');
include('header.php');
include('menu.php');
include('searchform.php');
include('topArticles.php');
$category=$_GET['cat'];
$sql="SELECT * FROM articles,users WHERE articles.AuthorID=users.id and articles.Categories LIKE '%".$category."%' and articles.Approved=1";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
{
    if(!isset($_SESSION['id']) || $_SESSION['id']!=$row['AuthorID'])
    {
        if($row['Approved']==1)
        {
            printArticle(($row),1);
        }
        else
        {
            echo "The article you are trying to find cannot be accessed";
        }
    }
    else if($_SESSION['id']==$row['AuthorID'])
    {
        printArticle(($row),0);
    }
}
?>
