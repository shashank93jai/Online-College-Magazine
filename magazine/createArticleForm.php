<?php
include('connection.php');
include('functions.php');
include('header.php');
include('menu.php');
include('searchform.php');
$sql="SELECT categoryName from categories";
$result=mysql_query($sql) or die(mysql_error());
?>
<html>
<head>
    <script type='text/javascript' src='functions.js'>
    </script>
    <link rel='stylesheet' type="text/css" href='css/styles.css'/>
    <link rel='stylesheet' type='text/css' href='bootstrap/bootstrap/css/bootstrap.css'/>
</head>
<body>
<div style='float:left'>
    <table>
	<form method='POST' action='createArticle.php'>
		 <tr>
             <td>Title:</td>
		    <td><input type='text' id='title' name='title'/></td>
			<td><div id='title_err'></div></td>
            <td rowspan="3" style='padding:100px'>
                <?php

                    while($row=mysql_fetch_array($result))
                        echo "<input type='checkbox' name='categories[]' value='".$row['categoryName']."'>".$row['categoryName']."<br>";
                ?>
            </td>
         </tr>
        <tr>
		 <td>Description:</td>
            <td><textarea id='description' name='description'  rows="20" cols="260"></textarea></td>
            <td><div id='description_err'></div></td>
        </tr>
        <tr>
            <td>Keywords:</td>
            <td><input type='text' id='keywords' name='keywords'/></td>
            <td><div id='keywords_err'></div></td>
	    <tr>
		 <td><input type='submit' value='create'/></td>
        </tr>
    </form>
    </table>
</div>

</body>
</html>
