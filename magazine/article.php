<?php
session_start();
include('connection.php');
include('functions.php');
include('header.php');
include('menu.php');
include('searchform.php');
include('topArticles.php');
$logged=logged_in();
if($logged)$userID=$_SESSION['id'];
else $userID=-1;
?>
<?php
if(!isset($_GET['id']))header('Location: index.php');
$sql="SELECT * FROM articles,users WHERE ArticleID=".$_GET['id']." AND users.id=articles.AuthorID ORDER BY Timestamp";
$result=mysql_query($sql);
if(mysql_num_rows($result)==0)echo "Page not found";
else
{
    $row=mysql_fetch_array($result);
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
$sql="SELECT * FROM comments LEFT JOIN users ON ArticleID=".$_GET['id']." AND (users.id=comments.AuthorID) ORDER BY Timestamp";
$result=mysql_query($sql) or die(mysql_error());
while($row=mysql_fetch_assoc($result))
{
    printComment($row);
}
?>
<html>
<head>
    <script>
        function showCommentForm()
        {
            document.getElementById('commentForm').style.display='block';
            document.getElementById('showFormButton').style.display='none';
        }
    </script>
</head>
<body>

<?php
$a=rand(1,10);
$b=rand(1,10);
$_SESSION['captcha']=$a+$b;

?>

<div id='commentForm' style="display: none">
    <form method="POST" action="addComment.php">
        <input type='hidden' name='userID' id='userID' value=<?php echo $userID ?> >
        <input type='hidden' name='articleID' id='articleID' value=<?php echo $_GET['id'] ?> >
        <textarea rows='5' cols='60' name='comment' id='comment'></textarea><br>
        <img src='image.php?a=<?php echo $a; ?>&b=<?php echo $b; ?>' style='width:50px;height:30px;'/>
        <input type='text' name='captcha' style="width: 40px;"/>
        <?php if(isset($_GET['err']) && $_GET['err']==1) echo "<div style='color: red'>retype the captcha</div>";?>
        <input type="submit" value="Add Comment" />
    </form>

</div>
<div id='showFormButton'>
    <button onclick="showCommentForm()">Add Comment</button>
</div>
<a href='index.php'>Return Home</a>
</body>
</html>
