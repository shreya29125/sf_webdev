<?php
	$nameerr=$passerr=$accerr=$infoerr="";
	$name=$pass=$acctype="";
	$user_id="";
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$username=$_POST['username'];
		$password=md5($_POST['password']);
		if(isset($_POST['adminuser']))
			$adminuser=$_POST['adminuser'];
		if(empty($username))
			$nameerr="Username is required";
		if(empty($password))
			$passerr="Password is required";
		if(empty($adminuser))
			$accerr="Type of account is required";
	}
	if(!empty($username) && !empty($password) && !empty($adminuser))
	{
		$result=$conn->prepare("SELECT id FROM users WHERE username=:username AND password=:password AND adminuser=:adminuser");
		$result->bindValue(':username',$username);
		$result->bindValue(':password',$password);
		$result->bindValue(':adminuser',$adminuser);
		$result->execute();
		$rows=$result->fetchALL();
		$num_rows=count($rows);
		if($num_rows==0)
			$infoerr="Invalid info";
		else
		{
			$user_id=$rows[0]['id'];
			$_SESSION['user_id']=$user_id;
			header('Location:index.php');
		}
	}
?>
<!DOCTYPE HTML>
<html lang>
<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<title>login page</title>
	<link href="loginform.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
</head>
<body>
	<h1>FORUM.COM</h1>
	<div class="form-container">
		<div class="form">
			<p>*marked fields are mandatory</p>
			<form action="<?php echo $current_file; ?>" method="POST">
				<label for="username">Username<span>*<?php echo $nameerr;?></span></label>
				<input id="username" type="text" name="username" value="<?php echo $name; ?>"><br><br>
				<label for="password">Password<span>*<?php echo $passerr;?></span></label>
				<input id="password" type="password" name="password" value="<?php echo $pass; ?>"><br><br>
				<input type="radio" name="adminuser" <?php if(isset($acctype) && $acctype=="admin") echo "checked"; ?> value="admin">Admin
				<input type="radio" name="adminuser" <?php if(isset($acctype) && $acctype=="user") echo "checked"; ?> value="user">User<span>*<?php echo $accerr;?></span><br><br>
				<span><?php echo $infoerr;?></span>
				<input id="login" type="submit" value="Login">
			</form>
				<p>Don't have an account? Sign up now</p>
				<a href='register.php' id="signup">Sign Up</a>
		</div>
	</div>
</body>
</html>
