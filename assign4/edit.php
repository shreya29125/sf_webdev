<?php
	include 'connect.php';
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
	}
?>
<!DOCTYPE HTML>
<html lang>
<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<title>login page</title>
	<link href="login.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital@1&display=swap" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div id="edit_content" style="display:inline-block">Content: <br><textarea id="text" name="text" rows="10" cols="49" required></textarea><br><br>
		<input type="submit" value="Add" class="add" onclick="insert2()";>&nbsp;<div class="discard" onclick="discard2()">Discard</div></div>
	</div>
</body>
</html>