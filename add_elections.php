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
		$election_name = mysqli_real_escape_string($conn,$_POST['election_name']);
		$start = mysqli_real_escape_string($conn,$_POST['start']);
		$end = mysqli_real_escape_string($conn,$_POST['end']);
		$description = mysqli_real_escape_string($conn,$_POST['description']);
		$start_time = strtotime($start);
		$end_time = strtotime($end);
		if($start_time < time())
		{
			echo '<script>alert("Start time for election must be greater than current time!");</script>';
			echo '<script>window.location.assign("start_election.php");</script>';
		}
		if($start_time > $end_time)
		{
			echo '<script>alert("Start time for election must be less than end time!");</script>';
			echo '<script>window.location.assign("start_election.php");</script>';
		}
		$start_time = date("Y-m-d H:i:s", $start_time);
		$end_time = date("Y-m-d H:i:s", $end_time);
		$result = mysqli_query($conn,"INSERT INTO election (name,description, start_time,end_time) VALUES ('$election_name','$description','$start_time', '$end_time')");
		if(!$result)
		{
			echo '<script>alert("There occurred an error");window.location.assign("start_election.php");</script>';
		}
		else
		{
			$_SESSION['election_id'] = mysqli_insert_id($conn);
			echo '<script>alert("Election Submitted Successfully");window.location.assign("voter.php");</script>';
		}
	}
	else if($_SERVER['REQUEST_METHOD'] == "GET")
	{
		$_SESSION['election_id'] = $_GET["eid"];
		echo '<script>window.location.assign("voter.php");</script>';
	}
	else
	{
		header("location:home.php");
	}
?>