<?php
session_start();
    $captcha=$_POST['captcha'];
    if($captcha==$_SESSION['captcha'])
    {
        if(!isset($_POST['userID']))header('Location: index.php');
        include('connection.php');
        include('header.php');
        include('functions.php');
        $comment=$_POST['comment'];
        $authorID=$_POST['userID'];
        $articleID=$_POST['articleID'];
        if(validComment($comment))
        {
            echo "yes";
            $sql="INSERT INTO comments (ArticleID,AuthorID,Comment) VALUES(".$articleID.",".$authorID.",\"".$comment."\")";
            $result=mysql_query($sql) or die(mysql_error());
            header('Location: article.php?id='.$articleID);
        }
    }
    else
    {
        $articleID=$_POST['articleID'];
        header('location:article.php?err=1&id='.$articleID);
    }
?>

