<?php
	require 'core.php';
	require 'connect.php';
	$nerr=$nameerr=$passerr=$accerr=$emailerr=$pass_againerr=$regerr="";
	$username=$password=$name=$email=$birthdate=$password_again="";
	$user_id="";
	$text="";
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$username=$_POST['username'];
		$password=$_POST['password'];
		$name=$_POST['name'];
		$email=$_POST['email'];
		$birthdate=$_POST['birthdate'];
		$password_again=$_POST['pass_again'];
		$password_hash=md5($password);
		if(isset($_POST['adminuser']))
			$adminuser=$_POST['adminuser'];
		if(empty($username))
			$nameerr="Username is required";
		if(empty($password))
			$passerr="Password is required";
		if(empty($adminuser))
			$accerr="Type of account is required";
		if(empty($name))
			$nerr="Name is required";
		if(empty($email))
			$emailerr="Email id is required";
		if(empty($password_again))
			$pass_againerr="Confirm your password";
	}
	if(!empty($username) && !empty($password) && !empty($name) && !empty($email) && !empty($password_again) && !empty($adminuser))
	{
		if(strlen($password)<8)
			$passerr="It must be of minimum 8 characters";
		elseif($password!=$password_again)
			$pass_againerr=$passerr="Passwords do not match";
		elseif(!preg_match("/^[a-zA-Z ]*$/",$name))
			$nerr="Enter a valid name";
		else
		{
			$query="SELECT email from users WHERE email='$email'";
			$result=$conn->prepare($query);
			$result->execute();
			$rows=$result->fetch();
			if($rows)
				$emailerr="Email already registered";
			else
			{
				$query="SELECT username from users WHERE username=:username";
				$result=$conn->prepare($query);
				$result->bindValue(':username',$username);
				$result->execute();
				$rows=$result->fetch();
				if($rows)
					$nameerr="Username already exists";
				else
				{
					$query="INSERT INTO users (username,password,name,email,adminuser,birthdate) VALUES (:username,:password,:name,:email,:adminuser,:birthdate)";
					$result=$conn->prepare($query);
					$result->bindParam(':username',$username);
					$result->bindParam(':password',$password_hash);
					$result->bindParam(':name',$name);
					$result->bindParam(':email',$email);
					$result->bindParam(':adminuser',$adminuser);
					$result->bindParam(':birthdate',$birthdate);
					$result->execute();
					$text="Click here to login";
				}
			}
		}
	}
?>
<!DOCTYPE HTML>
<html lang>
<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registration page</title>
	<link href="register.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
</head>
<body>
	<h1>FORUM.COM</h1>
	<div class="form-container">
		<div class="form">
			<p>*marked fields are mandatory</p>
			<form action="register.php" method="POST">
				<label for="name">Name<span>*<?php echo $nerr;?></span></label>
				<input id="name" type ="text" name="name" value="<?php echo $name; ?>"><br><br>
				<label for="username">Username<span>*<?php echo $nameerr;?></span></label>
				<input id="username" type="text" name="username" value="<?php echo $username; ?>"><br><br>
				<label for="email">Email<span>*<?php echo $emailerr;?></span></label>
				<input id="email" type="email" name="email" value="<?php echo $email; ?>"><br><br>
				<label for="password">Password<span>*<?php echo $passerr;?></span></label>
				<input id="password" type="password" name="password" value="<?php echo $password; ?>"><br><br>
				<label for="password_again">Confirm Password<span>*<?php echo $pass_againerr;?></span></label>
				<input id="password_again" type="password" name="pass_again" value="<?php echo $password_again; ?>"><br><br>
				<label for="birthdate">Birth-date</label>
				<input id="birthdate" type="date" name="birthdate" value="<?php echo $birthdate; ?>"><br><br>
				<label for="acctype">Type of Account<span>*<?php echo $accerr; ?></span></label><br>
				<input type="radio" name="adminuser" <?php if(isset($acctype) && $acctype=="admin") echo "checked"; ?> value="admin">Admin
				<input type="radio" name="adminuser" <?php if(isset($acctype) && $acctype=="user") echo "checked"; ?> value="user">User<br><br>
				<input id="signup" type="submit" value="Sign Up">&nbsp;<a href='index.php'>Click here to go back to login page</a>
			</form>
		</div>
	</div>
</body>
</html>