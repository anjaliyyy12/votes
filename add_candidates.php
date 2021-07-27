<?php 
	session_start();
	if($_SESSION['user']){
		$user=$_SESSION['user'];
	}
	else{
		header("location:index.php");
	}
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		$conn=mysqli_connect("34.126.191.48:3306", "root","pass4root") or die(mysqli_error($conn)); 
		mysqli_select_db($conn,"votes") or die("Cannot connect to database"); 
		$name=mysqli_real_escape_string($conn,$_POST['username']);
		$age=mysqli_real_escape_string($conn,$_POST['age']);
		$partyname=mysqli_real_escape_string($conn,$_POST['partyname']);
		mysqli_query($conn,"INSERT INTO candidates (name,age,partyname) VALUES ('$name','$age','$partyname')");
		echo '<script>alert("Candidate Added Successfully");window.location.assign("voter.php");</script>';
	
	}
	else
	{
		header("location:home.php");
	}
?>