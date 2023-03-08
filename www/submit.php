<html>
	<head>
		<title>Submit</title>
		<link rel="stylesheet" href="css/style.css">
		<meta name="viewport" content="width=device-width,initial-scale=1">

		<script src="js/valid.js"></script>
	</head>
	<body class="outer">
		<div class="inner">
		<header>
			<nav><a href="about.html">About</a>
			<a href="legal.html">Legal</a>
			<a href="index.html">Search</a>
			</nav>
			<h1 class="article_header">Submit A Link!</h1>
		</header>
<?php
	try
	{
		$db = new PDO("sqlite:_private/doculinkdb.sqlite");
		if(isset($_POST["url"]) && isset($_POST["desc"]))
		{
			$url = $_POST["url"];
			$desc = $_POST["desc"];
			$title = $_POST["title"];

			$url = filter_var($url, FILTER_SANITIZE_URL);
			$title = str_replace("'", "", $title);
			$title = str_replace("\"", "", $title);
			$desc = str_replace("'", "", $desc);
			$desc = str_replace("\"", "", $desc);

			/* sanitize url and desc */
			if(!filter_var($url, FILTER_VALIDATE_URL)) die("");
			if(strlen($title) > 32) die("");

			$query = "INSERT INTO search_terms(title, url, desc) VALUES('$title', '$url', '$desc')";
			$db->exec($query);
			
			echo "<script>alert('Submission successful!');</script>";


		}
	}
	catch(PDOException $e)
	{
		echo $e;
	}
	$db = null;
?>
		<div class="article_container">
		<main>
			<header><h2 class="article_header">
			Submission Details
			</h2></header>
			<form action="submit.php" method="POST" name="submit_form" onsubmit="return(isValid());">
				<label>URL
					<input type="text" name="url" class="submit_box" required>
				</label>
				<label>Title
					<input type="text" name="title" class="submit_box"required>
				</label>
				<label>Description
					<input type="text" name="desc" class="submit_box" required>
				</label>
				<input type="submit" value="Submit">
			</form>
			<aside>
			</aside>
		</main>
		<footer>
		</footer>
		</div>
		</div>
	</body>
</html>
