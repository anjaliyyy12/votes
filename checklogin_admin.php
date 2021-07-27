<?php 
	session_start();
	$conn=mysqli_connect("34.126.191.48:3306", "root", "pass4root") or die(mysqli_error($conn));
	mysqli_select_db($conn,"votes") or die("Cannot connect to database");
	$username=mysqli_real_escape_string($conn,$_POST['username']);
	$password=mysqli_real_escape_string($conn,$_POST['password']);
	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$query=mysqli_query($conn,"SELECT username,password,email FROM users WHERE username = 'admin'");
	$exists=mysqli_num_rows($query);
	$table_user="";
	$table_password="";
	$table_email="";
	if($exists>0)
	{
		while($row=mysqli_fetch_array($query))
		{
			$table_user=$row['username'];
			$table_password=$row['password'];
			$table_email=$row['email'];
		}
		if($username== $table_user)
		{
			if($password==$table_password)
			{
				if($email==$table_email)
				{
					$_SESSION['user']= $username;
					header("location:home_admin.php");
				}
			}
			else
			{
				echo '<script>alert("Incorrect Password or email!");</script>';
				echo '<script>window.location.assign("admin_login.php");</script>';
			}
		}
	}
	else
	{
		echo '<script>alert("Incorrect Username!");</script>';
		echo '<script>window.location.assign("admin_login.php");</script>';
	}
?>