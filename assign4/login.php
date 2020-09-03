<?php
	echo '<a id="logout" href="logout.php">Logout</a>';
	$user_id=getuserfield('id',$conn);
?>
<!DOCTYPE HTML>
<html lang>
<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<title>login page</title>
	<link href="login.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital@1&display=swap" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<script type="text/javascript">
		var str1,str2;
		function addtopic()
		{
			document.getElementById("add_topic").style.display="inline-block";
		}
		function editopic()
		{
			document.getElementById("edit_content").style.display="inline-block";
			<?php $query2="SELECT * FROM topics";
			$stmt=$conn->prepare($query2);
			$stmt->execute();
			$rows=$stmt->fetchAll(PDO::FETCH_ASSOC); ?>
		}
		function removetopic()
		{
			document.getElementById("remove_topic").style.display="inline-block";
			<?php $query2="SELECT * FROM topics";
			$stmt=$conn->prepare($query2);
			$stmt->execute();
			$allrows=$stmt->fetchAll(PDO::FETCH_ASSOC); ?>
		}
		function discard1()
		{
			document.getElementById("add_topic").style.display="none";
		}
		function discard2()
		{
			document.getElementById("edit_content").style.display="none";
		}
		function discard3()
		{
			document.getElementById("remove_topic").style.display="none";
		}
		function insert1()
		{
			if(window.XMLHttpRequest)
				var xmlhttp=new XMLHttpRequest();
			else
				var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.onreadystatechange=function()
			{
				if(xmlhttp.readyState==4 && xmlhttp.status==200)
					document.getElementById("new_topic").innerHTML=xmlhttp.responseText;
			};
			xmlhttp.open('GET','update.php?topic_name='+document.getElementById("topic_name").value+'&content='+document.getElementById("content").value,true);
			xmlhttp.send();
			var a=document.createElement("option");
			var text=document.createTextNode(document.getElementById("topic_name").value);
			a.appendChild(text);
			document.getElementById("topicname").appendChild(a);
			a.value=document.getElementById("topic_name");
			var a=document.createElement("option");
			var text=document.createTextNode(document.getElementById("topic_name").value);
			a.appendChild(text);
			document.getElementById("name_topic").appendChild(a);
			a.value=document.getElementById("name_topic");
		}
		function insert2()
		{
			if(window.XMLHttpRequest)
				var xhttps=new XMLHttpRequest();
			else
				var xhttps=new ActiveXObject("Microsoft.XMLHTTP");
			xhttps.onreadystatechange=function()
			{
				if(xhttps.readyState==4 && xhttps.status==200)
					document.getElementById("new_topic").innerHTML=xhttps.responseText;
			};
			xhttps.open('GET','update.php?topicname='+document.getElementById("topicname").value+'&changed_content='+document.getElementById("changed_content").value,true);
			xhttps.send();
		}
		function remove()
		{
			if(window.XMLHttpRequest)
				var xhttps=new XMLHttpRequest();
			else
				var xhttps=new ActiveXObject("Microsoft.XMLHTTP");
			xhttps.onreadystatechange=function()
			{
				if(xhttps.readyState==4 && xhttps.status==200)
					document.getElementById("new_topic").innerHTML=xhttps.responseText;
			};
			xhttps.open('GET','update.php?name_topic='+document.getElementById("name_topic").value,true);
			xhttps.send();
			var a=document.getElementById("topicname").getElementsByTagName("option");
			for(i=0;i<a.length;i++)
			{
				if(a[i].value==document.getElementById("name_topic").value)
					a[i].remove();
			}
			var a=document.getElementById("name_topic").getElementsByTagName("option");
			for(i=0;i<a.length;i++)
			{
				if(a[i].value==document.getElementById("name_topic").value)
					a[i].remove();
			}
		}
		function like(userid,rowid)
		{
				if(window.XMLHttpRequest)
					var xhttps=new XMLHttpRequest();
				else
					var xhttps=new ActiveXObject("Microsoft.XMLHTTP");
				xhttps.onreadystatechange=function()
				{
					if(xhttps.readyState==4 && xhttps.status==200)
						document.getElementById("new_topic").innerHTML=xhttps.responseText;
				};
				xhttps.open('GET','update.php?userid='+userid+'&rowid='+rowid,true);
				xhttps.send();
		}
		function dislike(_userid,_rowid)
		{
				if(window.XMLHttpRequest)
					var xhttps=new XMLHttpRequest();
				else
					var xhttps=new ActiveXObject("Microsoft.XMLHTTP");
				xhttps.onreadystatechange=function()
				{
					if(xhttps.readyState==4 && xhttps.status==200)
						document.getElementById("new_topic").innerHTML=xhttps.responseText;
				};
				xhttps.open('GET','update.php?_userid='+_userid+'&_rowid='+_rowid,true);
				xhttps.send();
		}
	</script>
</head>
<body>
	<h1>FORUM.COM<div><span>Welcome&nbsp;</span><span><?php echo getuserfield('username',$conn); ?></span><div><?php echo getuserfield('adminuser',$conn) ?></div></div></h1>
	<h2 onclick="addtopic()"><i class="fa fa-plus" style="width:50px"></i>Add Topic<br>
		<div class="line"></div></h2><br>
	<h2 onclick="editopic()"><i class="fa fa-pencil" style="width:50px"></i>Edit Topic<br>
		<div class="line"></div></h2><br>
	<h2 onclick="removetopic()"><i class="fa fa-trash-o" style="width:50px"></i>Remove Topic<br>
		<div class="line"></div></h2><br>
	<div class="container">
		<div id="add_topic">
			<form>
			<label for="topic_name">Topic Name: </label><input type="text" id="topic_name" name="topic_name" required><br><br>
			Content: <br><textarea id="content" name="content" rows="10" cols="35" required></textarea><br><br>
			<input type="button" value="Add" class="add" onclick="insert1();">&nbsp;<div class="discard" onclick="discard1()">Discard</div></form>
		</div>
	</div>
	<div class="container">
		<div id="edit_content">
			<form>
			<label for="topicname">Topic Name: </label><select type="text" id="topicname" name="topicname" required>
				<?php
					foreach($rows as $row)
					{
						echo '<option value="'.$row['topic_name'].'">'.$row['topic_name'].'</option';
						echo '<br>';
					}
				?>
			</select><br>
			Content: <br><textarea id="changed_content" name="changed_content" rows="10" cols="35" required></textarea><br><br>
			<input type="button" value="Add" class="add" onclick="insert2();">&nbsp;<div class="discard" onclick="discard2()">Discard</div></form>
		</div>
	</div>
	<div class="container">
		<div id="remove_topic">
			<form>
			<label for="name_topic">Which topic do you want to remove? </label><br><br><select type="text" id="name_topic" name="name_topic" required>
				<?php
					foreach($allrows as $row)
					{
						echo '<option value="'.$row['topic_name'].'">'.$row['topic_name'].'</option';
						echo '<br>';
					}
				?>
			</select><br><br>
			<input type="button" value="Remove" class="add" onclick="remove();">&nbsp;<div class="discard" onclick="discard3()">Discard</div></form>
		</div>
	</div>
	<div id="new_topic">
		<?php
		$query2="SELECT * FROM topics";
		$stmt=$conn->prepare($query2);
		$stmt->execute();
		$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($rows as $row)
		{
			$query=$conn->prepare('SELECT * FROM ratings WHERE userid=:userid AND rowid=:rowid');
			$query->bindParam(':userid',$user_id);
			$query->bindParam(':rowid',$row['id']);
			$query->execute();
			$contents=$query->fetchAll(PDO::FETCH_ASSOC);
			echo '<div class="topic '.$row['topic_name'].'">';
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
	</div>
</body>
</html>
