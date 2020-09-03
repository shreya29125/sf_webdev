<?php
	include 'connect.php';
	include 'core.php';
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
		$result=$conn->prepare("SELECT * FROM topics WHERE id=:id");
		$result->bindParam(":id",$id);
		$result->execute();
		$rows=$result->fetchAll(PDO::FETCH_ASSOC);
		$topic_name=$rows[0]['topic_name'];
	}
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
<script>
	var str1;
	function add()
		{
			if(window.XMLHttpRequest)
				var xml=new XMLHttpRequest();
			else
				var xml=new ActiveXObject("Microsoft.XMLHTTP");
			xml.onreadystatechange=function()
			{
				if(xml.readyState==4 && xml.status==200)
					document.getElementById("comments").innerHTML=xml.responseText;
			};
			xml.open('GET','new_comment.php?comment='+document.getElementById("comment").value+'&user_id='+<?php echo getuserfield('id',$conn); ?>+'&topic_name='+document.getElementsByClassName('topic_name')[0].innerHTML,true);
			xml.send();
		}
	function del(str)
	{
		if(window.XMLHttpRequest)
				var xml=new XMLHttpRequest();
			else
				var xml=new ActiveXObject("Microsoft.XMLHTTP");
			xml.onreadystatechange=function()
			{
				if(xml.readyState==4 && xml.status==200)
					document.getElementById("comments").innerHTML=xml.responseText;
			};
			xml.open('GET','new_comment.php?id='+str+'&topic_name='+document.getElementsByClassName('topic_name')[0].innerHTML,true);
			xml.send();
	}
	function func(str)
	{
		document.getElementById("edit").style.display="inline-block";
		str1=str;
	}
	function discard()
	{
		document.getElementById("edit").style.display="none";
	}
	function edit()
	{
		document.getElementById("edit").style.display="none";
		if(window.XMLHttpRequest)
			var xml=new XMLHttpRequest();
		else
			var xml=new ActiveXObject("Microsoft.XMLHTTP");
		xml.onreadystatechange=function()
		{
			if(xml.readyState==4 && xml.status==200)
				document.getElementById("comments").innerHTML=xml.responseText;
		};
		xml.open('GET','new_comment.php?row_id='+str1+'&topic_name='+document.getElementsByClassName('topic_name')[0].innerHTML+'&edit_comment='+document.getElementById("edit_comment").value,true);
		xml.send();
	}
	function show(str)
	{
		a=document.getElementsByClassName(str);
		if(a[0].style.display=="none")
		{
			if(a.length==1)
				a[0].style.display="inline-block";
			else
			{
				a[0].style.display="inline-block";
				a[1].style.display="inline-block";
			}
		}
		else
		{
			if(a.length==1)
				a[0].style.display="none";
			else
			{
				a[0].style.display="none";
				a[1].style.display="none";
			}
		}
	}
</script>
<body>
	<h1>FORUM.COM<div><span>Welcome&nbsp;</span><span><?php echo getuserfield('username',$conn); ?></span><div><?php echo getuserfield('adminuser',$conn) ?></div></div></h1>
	<div class="topic">
		<div class="topic_name"><?php echo $rows[0]['topic_name']; ?></div>
		<div class="content"><?php echo $rows[0]['content']; ?></div>
	</div>
	<div id="comments">
	<?php
		$query2=$conn->prepare('SELECT * FROM comments WHERE topic_name=:topic_name');
		$query2->bindParam(':topic_name',$topic_name);
		$query2->execute();
		$rows=$query2->fetchAll(PDO::FETCH_ASSOC);
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
	</div>
	<div class="box"><label for="comment">Type a comment: </label><input type="text" id="comment" name="comment" required>&nbsp;<input type="submit" value="Add" id="submit" onclick="add();"></div>
	<div id="edit"><label for="edit_comment">Edit comment: </label><input type="text" id="edit_comment" name="edit_comment">&nbsp;<input type="submit" value="Edit" onclick="edit();"><button class="discard" onclick="discard()">Discard</button></div>
</body>
</html>