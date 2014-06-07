<link rel='stylesheet' type="text/css" href='css/styles.css'/>
<link rel='stylesheet' type='text/css' href='bootstrap/bootstrap/css/bootstrap.css'/>
<script type='text/javascript' src="functions.js">
</script>
<?php
session_start();

include('connection.php');
include('functions.php');
include('header.php');
include('menu.php');
include('searchform.php');
function edit_admin()
{
    echo "<h3>Select Your Moderators</h3>";
    $sql=mysql_query("SELECT *FROM users");
    echo "<table class='table table-condensed'><form action='edit.php' method='post'>";
    while($row=mysql_fetch_array($sql))
    {
        if($row['permissions']==2)
            $val='checked=\'checked\'';
        else $val='';
        echo "<tr><td><input type='checkbox'".$val." name='user[]' value='".$row['id']."'/></td><td>" .$row["name"]."</td><td>".$row['roll']."</td>";
    }
    echo "<tr><td><input type='submit' class='btn btn-small btn-primary' onclick='return disp_confirm()' value='Update Moderators'/></td><td></td><td></td></tr>";
    echo '</table></form>';
}
function edit_mod()
{
    echo "<h3>Moderator Options</h3>";
    echo "<form action='edit.php' method='post'><table class='table table-condensed'>
            <br><tr><td>Approved</td><td>Disapproved</td><td>Pending</td><td>Article Title</td><td>Status</td><td>Author</td></tr>
    ";
    $sql=mysql_query("SELECT *FROM articles ORDER BY Timestamp");
    echo '<br>';
    while($row=mysql_fetch_array($sql))
    {
        $sql1=mysql_query("SELECT * from users WHERE id=".$row['AuthorID']);
        $row1=mysql_fetch_array($sql1);

        if($row['Approved']==1)
        {
            $status='Approved';
            $val="checked='checked'";
            $val1="";
            $val2="";
        }
        else if($row['Approved']==2)
        {
            $status='Unapproved';
            $val1="checked='checked'";
            $val="";
            $val2="";
        }
        else if($row['Approved']==0)
        {
            $status='Pending';
            $val2="checked='checked'";
            $val="";
            $val1="";
        }
        echo "<tr>
            <td><input type='radio' name='approve".$row['ArticleID']."' value='Approved' ".$val."/></td>
            <td><input type='radio' name='approve".$row['ArticleID']."' value='Disapproved' ".$val1."/></td>
            <td><input type='radio' name='approve".$row['ArticleID']."' value='Pending' ".$val2."></td>
        <td>".$row['Title']."</td><td>".$status."</td><td>".$row1['name']."</td>
        <td><input type='hidden' name='approve[]' value='".$row['ArticleID']."'/>";

    }
    echo "<tr><td><input type='submit' class='btn btn-small btn-primary' onclick='disp_confirm()' value='Confirm'/></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
}
function edit_normal()
{
    $id=$_SESSION['id'];
    $sql=mysql_query("SELECT * FROM articles WHERE AuthorID=".$id);
    echo "
    <form action='edit.php?mode=1' method='post'>
    <table class='table table-condensed'>
            ";
    while($row=mysql_fetch_array($sql))
    {
        if($row['Approved']==0)
            $approved="Pending";
        else if($row['Approved']==1)
            $approved="Approved";
        else
            $approved="Unapproved";
        echo "<tr><td><input type='checkbox' name='check[]' value='".$row['ArticleID']."'/><td><a href='edit.php?id=".$row['ArticleID']."'>".$row['Title']."</a></td><td>".$row['Timestamp']."</td><td>(".$approved.")</td></tr>";
    }
    echo "<tr><td><input type='submit' class='btn btn-small btn-primary' onclick='return  disp_confirm()' value='delete'/> </td><td></td><td><td></td></tr></table></form>";
}
function edit_article($id,$title,$description,$keywords,$categories)
{
    $sql=mysql_query('SELECT categoryName FROM categories');
    echo "<table>
	<form method='POST' action='createArticle.php?mode=1&id=".$id."'>
		 <tr>
             <td>Title:</td>
		    <td><input type='text' id='title' name='title' value='".$title."'/></td>
			<td><div id='title_err'></div></td>
			<td rowspan='3'>
	        ";
    $categories=explode(" ",$categories);
    while($row=mysql_fetch_array($sql))
    {
        $val='';
        foreach($categories as $category)
        {
            if($category==$row['categoryName'])
                $val="checked='checked'";
        }
        echo "<input type='checkbox' name='categories[]' value='".$row['categoryName']."' $val>".$row['categoryName']."<br>";
    }

    echo "
    </td>
         </tr>
        <tr>
		 <td>Description:</td>
            <td><textarea id='description' name='description'  rows='20' cols='60'>".$description."</textarea></td>
            <td><div id='description_err'></div></td>
        </tr>
        <tr>
            <td>Keywords:</td>
            <td><input type='text' id='keywords' name='keywords'  value='".$keywords."'/></td>
            <td><div id='keywords_err'></div></td>
	    <tr>
		 <td><input type='submit' class='btn btn-small btn-primary' value='Edit Article'/></td>
        </tr>
        </form>
    </table>";
}
function delete_articles()
{
    foreach($_POST['check'] as $id)
    {
        mysql_query("DELETE FROM articles WHERE ArticleID=".$id);
    }
    header("location:edit.php");
}

if(isset($_GET['mode']) && $_GET['mode']==1)
{
    delete_articles();
}
else if(isset($_GET['mode']) && $_GET['mode']=='admin')
{
    if($_SESSION['permissions']==1)
        edit_admin();
    else
        echo 'not enough permission';
}
else if(isset($_GET['mode']) && $_GET['mode']=='mod')
{
    if($_SESSION['permissions']==2 || $_SESSION['permissions']==1)
        edit_mod();
    else
        echo 'not enough permissions';
}
else if(isset($_POST['user']))
{
    $sql=mysql_query("UPDATE users SET permissions=0 WHERE permissions!=1");
    foreach($_POST['user'] as $id)
    {
        $sql=mysql_query("UPDATE users SET permissions=2 WHERE id=".$id);
    }
    header("location:./edit.php?mode=admin");
}
else if(isset($_POST['approve']))
{
    $sql=mysql_query("UPDATE articles SET Approved=0");
    foreach($_POST['approve'] as $id)
    {
        $var='approve'.$id;
        if($_POST[$var]=="Approved")
            $status=1;
        else if($_POST[$var]=="Disapproved")
            $status=2;
        else
            $status=0;
        echo $status."<br>";
        echo  $_POST[$var]."<br>";
        //echo "UPDATE articles SET Approved=".$status." WHERE ArticleID=".$id."<br>";
        $sql="UPDATE articles SET Approved=".$status." WHERE ArticleID=".$id;
        $result=mysql_query($sql);
    }
    header("location:./edit.php?mode=mod");
}
else if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $sql=mysql_query("SELECT * FROM articles WHERE ArticleID=".$id);
    $row=mysql_fetch_array($sql);
    if(isset($_SESSION['id']))
    {
        if($row['AuthorID']==$_SESSION['id'] || $_SESSION['permissions']==1 || $_SESSION['permissions']==2)
        {
            edit_article($id,$row['Title'],$row['Description'],$row['Keywords'],$row['Categories']);
        }
        else
            echo 'You do not have  permissions to edit this article';
    }
    else
        echo 'You do not have  permissions to edit this article';
}
else
    edit_normal();
