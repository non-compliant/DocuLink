<?php
	// TODO: q = query and n = page num
	if(!isset($_POST['q']) || !isset($_POST['n'])) header("LOCATION: index.html\r\n");
?>
<html>
	<head>
		<title><?php echo $_POST['q']; ?> results</title>
		<link rel="stylesheet" href="css/style.css">
		<meta name="viewport" content="width=device-width,initial-scale=1">
	</head>
	<body class="outer">
	<div class="inner">
		<header>
		<nav><a href="about.html">About</a>
		<a href="legal.html">Legal</a>
		<a href="index.html">Search</a>
		<a href="submit.php">Submit A Link!</a>
		</nav>
		<h1 class="article_header">Results for <?php echo $_POST['q']; ?>...</h1>
		</header>
		<div style="margin: 5px;">
<?php
	/* open db connection and read all results matching q */
	try
	{
		$search_query = $_POST['q'];
		$page_limit = number_format($_POST['n']);

		$search_query = str_replace("\"", "", $search_query);
		$search_query = str_replace("'", "", $search_query);

		$db = new PDO("sqlite:_private/doculinkdb.sqlite");
		$SQL_sel = "SELECT *";
		$SQL_count_sel = "SELECT COUNT(*)";
		$SQL_query_rest = " FROM ( SELECT ROW_NUMBER() OVER ( ORDER BY title ) AS row_num, * FROM search_terms WHERE desc LIKE"
		. " \"%$search_query%\" OR title LIKE \"%$search_query%\""
		. ") AS row_constrained_result WHERE row_num >= " . ($page_limit - 9)
		. " AND row_num <= " . $page_limit . " ORDER BY row_num;";

		$results = $db->query($SQL_sel . $SQL_query_rest );
		$count_results = $db->query($SQL_count_sel . $SQL_query_rest);
		$count_results = $count_results->fetchColumn();
		
		if($count_results == 0) echo "<p>No results...</p>";

		foreach($results as $search_term)
		{
			echo "<a href='" . $search_term["url"]
			. "'>" . $search_term["title"] . "</a>"
			. "<p>" . $search_term["desc"] . "</p>";
		}

		if($count_results > 9)
			echo "<form method=\"POST\"><input type=\"hidden\" name=\"q\" value=\"$search_query\">"
			. "<input type=\"hidden\" name=\"n\" value=\"" . ($page_limit + 10) . "\">"
			. "<input type=\"submit\" value=\"Load more...\"></form>";
	}
	catch(PDOException $e)
	{
		alert($e);
	}
	$db = null;
?>
	</div>
	</div>
	</body>
</html>
