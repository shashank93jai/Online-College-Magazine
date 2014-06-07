<?php
session_start();
include('connection.php');
//include('functions.php');
include('header.php');
include('menu.php');
include('searchform.php');
//include('topArticles.php');

function validate_article()
{
	$allValid=True;
    $title=$_POST['title'];
    $description=$_POST['description'];
    $keywords=$_POST['keywords'];
    $x=1;
    if($allValid)
        return true;
    else
        return False;
}
function add_article()
{
    $title=$_POST['title'];
    $description=mysql_real_escape_string($_POST['description']);
    $keywords=$_POST['keywords'];
    $id=$_SESSION['id'];
    if(isset($_POST['categories']))
        $categories=$_POST['categories'];
    else $categories='';
    $str='';
    if($categories=='')
    {
        $str='Others';
    }
    else
    {
        foreach($categories as $category)
        {
            $str.=$category;
            $str.=' ';
        }
        $str=substr($str,0,strlen($str)-1);
    }
    mysql_query("INSERT INTO articles(Title,Description,AuthorID,Rating,Keywords,Categories) VALUES(\"".$title."\",\"".$description."\",".$id.",5,\"".$keywords."\",\"".$str."\")") or die(mysql_error());
}
function update_article()
{
    $ArticleID=$_GET['id'];
    $title=$_POST['title'];
    $description=mysql_real_escape_string($_POST['description']);
    $keywords=$_POST['keywords'];
    $id=$_SESSION['id'];
    if(isset($_POST['categories']))
        $categories=$_POST['categories'];
    else $categories='';
    $str='';
    if($categories=='')
    {
        $str='Others';
    }
    else
    {
        foreach($categories as $category)
        {
            $str.=$category;
            $str.=' ';
        }
        $str=substr($str,0,strlen($str)-1);
    }
    mysql_query("UPDATE articles SET  Approved=0,Title='".$title."',Description='".$description."',Keywords='".$keywords."',Categories='".$str."' WHERE ArticleID=".$ArticleID);
}
function delete_articles()
{
    echo 'deleting';
}
function logged_in()
{
    if(isset($_SESSION['name']))
        return True;
    return False;
}
$logged=logged_in();

if(isset($_POST['title']) && !isset($_GET['mode']))
{
    add_article();
    echo 'added successfully';
}
else if(isset($_POST['title']) && $_GET['mode']==1)
{
    update_article();
    echo 'Update successfully';
}
else
{
    include('createArticleForm.php');
}
if(!$logged)header('Location: loginform.php');

?>
