<div id='search-form'>
<form method="GET" action="search.php">
	<input placeholder="Enter Query.." type="text" name="searchQ" id="searchQ" value=<?php if(isset($_GET['searchQ']))echo mysql_real_escape_string($_GET['searchQ']) ?> >
	<input type="submit" name="submit" id="submit"  value='search' class="btn btn-mini btn-primary"/>
</form>
</div>
