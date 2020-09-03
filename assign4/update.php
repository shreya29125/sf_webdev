<?php
	include 'connect.php';
	include 'core.php';
	$user_id=getuserfield('id',$conn);
	if(isset($_GET['topic_name']) && isset($_GET['content']))
	{
		$topic_name=$_GET['topic_name'];
		$content=$_GET['content'];
		$inspect=$conn->prepare("SELECT id FROM topics WHERE topic_name=:topic_name AND content=:content");
		$inspect->bindParam(':topic_name',$topic_name);
		$inspect->bindParam(':content',$content);
		$inspect->execute();
		$rows1=$inspect->fetchAll();
		if(count($rows1)==0)
		{
			$query="INSERT INTO topics (topic_name,content) VALUES (:topic_name,:content)";
			$result=$conn->prepare($query);
			$result->bindParam(':topic_name',$topic_name);
			$result->bindParam(':content',$content);
			$result->execute();
		}
	}
	if(isset($_GET['topicname']) && isset($_GET['changed_content']))
	{
		$topic_name=$_GET['topicname'];
		$changed_content=$_GET['changed_content'];
		$inspect=$conn->prepare("UPDATE topics SET content=:content WHERE topic_name=:topic_name");
		$inspect->bindParam(':topic_name',$topic_name);
		$inspect->bindParam(':content',$changed_content);
		$inspect->execute();
	}
	if(isset($_GET['name_topic']))
	{
		$topic_name=$_GET['name_topic'];
		$inspect=$conn->prepare("DELETE FROM topics WHERE topic_name=:topic_name");
		$inspect->bindParam(':topic_name',$topic_name);
		$inspect->execute();
	}
	if(isset($_GET['userid']) && isset($_GET['rowid']))
	{
		$userid=$_GET['userid'];
		$rowid=$_GET['rowid'];
		$inspect=$conn->prepare('SELECT * FROM ratings WHERE userid=:userid AND rowid=:rowid');
		$inspect->bindParam(':userid',$userid);
		$inspect->bindParam(':rowid',$rowid);
		$inspect->execute();
		$rows=$inspect->fetchAll(PDO::FETCH_ASSOC);
		if(!(count($rows)>0))
		{
			$query=$conn->prepare('INSERT INTO ratings (userid,rowid,rating) VALUES (:userid,:rowid,"LIKE")');
			$query->bindParam(':userid',$userid);
			$query->bindParam(':rowid',$rowid);
			$query->execute();
			$query=$conn->prepare('SELECT * FROM topics WHERE id=:rowid');
			$query->bindParam(':rowid',$rowid);
			$query->execute();
			$contents=$query->fetchAll(PDO::FETCH_ASSOC);
			$new_value=$contents[0]['likes']+1;
			$inspect=$conn->prepare('UPDATE topics SET likes=:likes WHERE id=:id');
			$inspect->bindParam(':id',$rowid);
			$inspect->bindParam(':likes',$new_value);
			$inspect->execute();
		}
		else
		{
			if($rows[0]['rating']=='LIKE')
			{
				$query=$conn->prepare('DELETE FROM ratings WHERE userid=:userid AND rowid=:rowid');
				$query->bindParam(':userid',$userid);
				$query->bindParam(':rowid',$rowid);
				$query->execute();
				$query=$conn->prepare('SELECT * FROM topics WHERE id=:rowid');
				$query->bindParam(':rowid',$rowid);
				$query->execute();
				$contents=$query->fetchAll(PDO::FETCH_ASSOC);
				$new_value=$contents[0]['likes']-1;
				$inspect=$conn->prepare('UPDATE topics SET likes=:likes WHERE id=:id');
				$inspect->bindParam(':id',$rowid);
				$inspect->bindParam(':likes',$new_value);
				$inspect->execute();
			}
		}
	}
	if(isset($_GET['_userid']) && isset($_GET['_rowid']))
	{
		$userid=$_GET['_userid'];
		$rowid=$_GET['_rowid'];
		$inspect=$conn->prepare('SELECT * FROM ratings WHERE userid=:userid AND rowid=:rowid');
		$inspect->bindParam(':userid',$userid);
		$inspect->bindParam(':rowid',$rowid);
		$inspect->execute();
		$rows=$inspect->fetchAll(PDO::FETCH_ASSOC);
		if(!(count($rows)>0))
		{
			$query=$conn->prepare('INSERT INTO ratings (userid,rowid,rating) VALUES (:userid,:rowid,"DISLIKE")');
			$query->bindParam(':userid',$userid);
			$query->bindParam(':rowid',$rowid);
			$query->execute();
			$query=$conn->prepare('SELECT * FROM topics WHERE id=:rowid');
			$query->bindParam(':rowid',$rowid);
			$query->execute();
			$contents=$query->fetchAll(PDO::FETCH_ASSOC);
			$new_value=$contents[0]['dislikes']+1;
			$inspect=$conn->prepare('UPDATE topics SET dislikes=:dislikes WHERE id=:id');
			$inspect->bindParam(':id',$rowid);
			$inspect->bindParam(':dislikes',$new_value);
			$inspect->execute();
		}
		else
		{
			if($rows[0]['rating']=='DISLIKE')
			{
				$query=$conn->prepare('DELETE FROM ratings WHERE userid=:userid AND rowid=:rowid');
				$query->bindParam(':userid',$userid);
				$query->bindParam(':rowid',$rowid);
				$query->execute();
				$query=$conn->prepare('SELECT * FROM topics WHERE id=:rowid');
				$query->bindParam(':rowid',$rowid);
				$query->execute();
				$contents=$query->fetchAll(PDO::FETCH_ASSOC);
				$new_value=$contents[0]['dislikes']-1;
				$inspect=$conn->prepare('UPDATE topics SET dislikes=:dislikes WHERE id=:id');
				$inspect->bindParam(':id',$rowid);
				$inspect->bindParam(':dislikes',$new_value);
				$inspect->execute();
			}
		}
	}
	$stmt=$conn->prepare("SELECT * FROM topics");
	$stmt->execute();
	$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
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
	<?php
		foreach($rows as $row)
		{
			$query=$conn->prepare('SELECT * FROM ratings WHERE userid=:userid AND rowid=:rowid');
			$query->bindParam(':userid',$user_id);
			$query->bindParam(':rowid',$row['id']);
			$query->execute();
			$contents=$query->fetchAll(PDO::FETCH_ASSOC);
			echo '<div class="topic">';
				echo '<div class="topic_name">'.$row['topic_name'].'</div>';
				echo '<div class="content">'.$row['content'].'</div>';
				echo '<div class="changes">';
					if(count($contents)>0 && $contents[0]['rating']=='LIKE') echo '<span id="like" onclick="like('.$user_id.','.$row['id'].')"><i class="fa fa-thumbs-up" width="20px"></i>&nbsp;'.$row['likes'].'</span>';
					else echo '<span id="like" onclick="like('.$user_id.','.$row['id'].')"><i class="fa fa-thumbs-o-up" width="20px"></i>&nbsp;'.$row['likes'].'</span>';
					if(count($contents)>0 && $contents[0]['rating']=='DISLIKE') echo '<span id="dislike" onclick="dislike('.$user_id.','.$row['id'].')"><i class="fa fa-thumbs-down" width="20px"></i>&nbsp;'.$row['dislikes'].'</span>';
					else echo '<span id="dislike" onclick="dislike('.$user_id.','.$row['id'].')"><i class="fa fa-thumbs-o-down" width="20px"></i>&nbsp;'.$row['dislikes'].'</span>';
					echo '<a id="comment" href="comment.php?id='.$row['id'].'"><i class="fa fa-comment-o" aria-hidden="true"></i>&nbsp;Comment</a>';
				echo '</div>';
			echo '</div>';
		}
	?>
</body>
</html>