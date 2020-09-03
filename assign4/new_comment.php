<?php
	include 'connect.php';
	include 'core.php';
	if(isset($_GET['comment']) && isset($_GET['topic_name']) && isset($_GET['user_id']))
	{
		$comment=$_GET['comment'];
		$topic_name=$_GET['topic_name'];
		$user_id=$_GET['user_id'];
		if(!empty($comment) && !empty($topic_name) && !empty($user_id))
		{
			$inspect=$conn->prepare('SELECT * FROM users WHERE id=:id');
			$inspect->bindParam(':id',$user_id);
			$inspect->execute();
			$result=$inspect->fetchAll(PDO::FETCH_ASSOC);
			$name=$result[0]['username'];
			$query=$conn->prepare('INSERT INTO comments (comment,topic_name,name) VALUES (:comment,:topic_name,:name)');
			$query->bindParam(':comment',$comment);
			$query->bindParam(':topic_name',$topic_name);
			$query->bindParam(':name',$name);
			$query->execute();
		}
	}
	if(isset($_GET['id']) && isset($_GET['topic_name']))
	{
		$id=$_GET['id'];
		$topic_name=$_GET['topic_name'];
		$inspect=$conn->prepare('DELETE FROM comments WHERE id=:id');
		$inspect->bindParam(':id',$id);
		$inspect->execute();
	}
	if(isset($_GET['row_id']) && isset($_GET['topic_name']) && isset($_GET['edit_comment']))
	{
		$id=$_GET['row_id'];
		$topic_name=$_GET['topic_name'];
		$comment=$_GET['edit_comment'];
		$inspect=$conn->prepare('UPDATE comments SET comment=:comment WHERE id=:id');
		$inspect->bindParam(':id',$id);
		$inspect->bindParam(':comment',$comment);
		$inspect->execute();
	}
	$query2=$conn->prepare('SELECT * FROM comments WHERE topic_name=:topic_name');
	$query2->bindParam(':topic_name',$topic_name);
	$query2->execute();
	$rows=$query2->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE HTML>
<html lang>
<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<title>comments</title>
	<link href="comment.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital@1&display=swap" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
	<?php
		foreach($rows as $row)
		{
			echo '<div class="container">';
				echo '<div class="name"><b>'.$row['name'].'</b>&nbsp;&nbsp;<i class="fa fa-ellipsis-v" onclick="show('.$row['id'].')"></i></div>';
				echo '<div class="comment">'.$row['comment'].'</div>';
				if(getuserfield('adminuser',$conn)=='admin')
					echo '<button class="delete '.$row['id'].'" onclick="del('.$row['id'].')">Delete</button>';
				if(getuserfield('username',$conn)==$row['name']) echo '<button class="edit '.$row['id'].'" onclick="func('.$row['id'].')">Edit</button>';
			echo '</div>';
			echo '<br>';
			echo '<br>';
		}
	?>
</body>
</html>